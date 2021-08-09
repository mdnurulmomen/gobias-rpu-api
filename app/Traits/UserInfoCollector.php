<?php

namespace App\Traits;

use App\Models\Menu;
use App\Models\MenuRoleMap;
use App\Models\OfficeFrontDesk;
use App\Models\OfficeUnitOrganogram;
use App\Models\ProtikolpoManagement;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait UserInfoCollector
{
    use ApiHeart;

    public function getUserDetails()
    {
        return session('login') ? session('login')['user'] : Auth::user();
    }

    public function checkLogin(): bool
    {
        $login_cookie = isset($_COOKIE['_ndoptor']) ? $_COOKIE['_ndoptor'] : null;
        if ($login_cookie) {
            $login_data_from_cookie = json_decode(gzuncompress(base64_decode($login_cookie)), true);
            if ($login_data_from_cookie && $login_data_from_cookie['status'] === 'success') {
                $user = User::where('username', $login_data_from_cookie['user_info']['user']['username'])->first();
                Auth::login($user);
                return true;
            }
        } else if ($login_cookie == null && Auth::check() && app()->environment('local')) {
            return true;
        }
        return false;
    }

    public function getUserOfficesByDesignation()
    {
        return (Auth::user()->employee) ? Auth::user()->employee->employee_office : [];
    }

    public function isUserHasRole(): bool
    {
        $role = $this->getAssignedMenus();
        return $role->count() > 0;
    }

    public function getAssignedMenus()
    {
        $isFrontDesk = $this->isUserInFrontDesk();
        $user_role_id = $this->getUserRoleId();
        $user_office_roles = $this->getUserOfficeRoles();
        $menus = collect();
        if ($user_role_id == config('menu_role_map.super_admin')) {
            $role_menu = $this->getUserRoleMenu($user_role_id);
            $menus = $menus->merge($role_menu);
        }
        if ($user_role_id == config('menu_role_map.admin')) {
            $role_menu = $this->getUserRoleMenu($user_role_id);
            $menus = $menus->merge($role_menu);

        }
        if ($user_role_id == config('menu_role_map.user')) {
            $role_menu = $this->getUserRoleMenu($user_role_id);
            $menus = $menus->merge($role_menu);

        }
//        if ($user_role_id == config('menu_role_map.user')) {
//            if ($user_office_roles) {
//                if ($user_office_roles->is_unit_admin == 1) {
//                    $role_menu = $this->getUserRoleMenu(config('menu_role_map.unit_admin'));
//                    $menus = $menus->merge($role_menu);
//                }
//                if ($user_office_roles->is_unit_head == 1) {
//                    $role_menu = $this->getUserRoleMenu(config('menu_role_map.unit_head'));
//                    $menus = $menus->merge($role_menu);
//                }
//                if ($user_office_roles->is_office_head == 1) {
//                    $role_menu = $this->getUserRoleMenu(config('menu_role_map.office_head'));
//                    $menus = $menus->merge($role_menu);
//                }
//                if ($user_office_roles->is_admin == 1) {
//                    $role_menu = $this->getUserRoleMenu(config('menu_role_map.office_admin'));
//                    $menus = $menus->merge($role_menu);
//                }
//                if ($isFrontDesk == 1) {
//                    $role_menu = $this->getUserRoleMenu(config('menu_role_map.office_frontdesk'));
//                    $menus = $menus->merge($role_menu);
//                }
//            }
//        }

        return $menus->unique();
    }

    public function isUserInFrontDesk(): int
    {
        $frontDesk = OfficeFrontDesk::where('office_unit_organogram_id', Auth::user()->current_designation_id())->pluck('id');
        return $frontDesk->isEmpty() ? 0 : 1;
    }

    public function getUserRoleId()
    {
        return Auth::user()->user_role_id;
    }

    public function getUserOfficeRoles()
    {
        if (Auth::user()->current_designation_id()) {
            return OfficeUnitOrganogram::find(Auth::user()->current_designation_id());
        }
    }

    public function getUserRoleMenu($role_id)
    {
        $roleMenuMapIds = MenuRoleMap::where('role_id', $role_id)->pluck('menu_id');
        return Menu::whereIn('id', $roleMenuMapIds)->with([
            'children' => function ($query) use ($roleMenuMapIds) {
                $query->whereIn('id', $roleMenuMapIds);
            }])->where('parent_menu_id', '0')->get();
    }

    public function getUserOrganogramRoleName(): string
    {
        $role = $this->getUserOrganogramRole();
        if (Auth::user()->user_role_id == config('menu_role_map.super_admin')) {
            $role_name = 'সুপার অ্যাডমিন';
        } else if (Auth::user()->user_role_id == config('menu_role_map.admin')) {
            $role_name = 'অ্যাডমিন';
        } else if ($role == config('menu_role_map.office_admin')) {
            $role_name = 'অফিস অ্যাডমিন';
        } else if ($role == config('menu_role_map.office_head')) {
            $role_name = 'অফিস প্রধান';
        } else if ($role == config('menu_role_map.unit_admin')) {
            $role_name = 'শাখা অ্যাডমিন';
        } else if ($role == config('menu_role_map.unit_head')) {
            $role_name = 'শাখা প্রধান';
        } else if ($role == config('menu_role_map.office_frontdesk')) {
            $role_name = 'ফ্রন্ট ডেস্ক';
        } else {
            $role_name = '';
        }

        return $role_name;
    }

    public function getUserOrganogramRole()
    {
        if ($this->getUserRoleId() == config('menu_role_map.user') && Auth::user()->current_designation_id()) {
            $designation_id = Auth::user()->current_designation_id();
            $unit_organogram = OfficeUnitOrganogram::where('id', $designation_id)->first();
            if ($unit_organogram && $unit_organogram->is_admin) {
                return config('menu_role_map.office_admin');
            } else if ($unit_organogram && $unit_organogram->is_unit_admin) {
                return config('menu_role_map.unit_admin');
            } else if ($unit_organogram && $unit_organogram->is_unit_head) {
                return config('menu_role_map.unit_head');
            } else if ($unit_organogram && $unit_organogram->is_office_head) {
                return config('menu_role_map.office_head');
            } else {
                return null;
            }
        }
        return null;
    }

    public function checkProtikolpo(): bool
    {
        if (Auth::user()->employee) {
            $employee_record_id = Auth::user()->employee->id;

            $protikolpo_count = ProtikolpoManagement::where('employee_record_id', $employee_record_id)->where('active_status', 1)
                ->exists();
            if ($protikolpo_count) {
                return true;
            }
        }
        return false;
    }
}
