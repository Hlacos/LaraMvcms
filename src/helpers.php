<?php

function hasPermission($permissionName)
{
    $admin = Auth::admin()->get();
    $permission = Hlacos\LaraMvcms\Models\Permission::where('name', $permissionName)->first();

    if ($admin && $permission) {
        return $admin->hasPermission($permission);
    }

    return false;
}

function hasPermissions($permissions, $conjuction = 'and')
{
    if ($conjuction == 'and') {
        foreach ($permissions as $permission) {
            if (!hasPermission($permission)) {
                return false;
            }
        }

        return true;
    } elseif ($conjuction == 'or') {
        foreach ($permissions as $permission) {
            if (hasPermission($permission)) {
                return true;
            }
        }

        return false;
    } else {
        throw new Exception("Illegal grammatical conjuction: {$conjuction}");
    }
}

function isRoute($route)
{
    return request()->route()->getName() == $route;
}

function hasRoute($route, $routeParams = null)
{
    return strpos(request()->route()->getName(), $route) !== false;
}

function readableSize($size)
{
    if ($size > 1024) {
        if ($size > 1024 * 1024) {
            if ($size > 1024 * 1024 * 1024) {
                return number_format($size / 1024 / 1024 / 1024, 2, ",", " ")." GB";
            } else {
                return number_format($size / 1024 / 1024, 2, ",", " ")." MB";
            }
        } else {
            return number_format($size / 1024, 2, ",", " ")." KB";
        }
    } else {
        return number_format($size, 2, ",", " ")." B";
    }
}

function iconByMime($mime)
{
    if (preg_match('/^image.*$/', $mime) === 1) {
        return 'fa-file-image-o';
    }

    if (preg_match('/^.*excel$/', $mime) === 1) {
        return 'fa-file-excel-o';
    }

    //TODO better function

    return 'fa-file-o';
}

function shortened($text, $length) {
    if (strlen($text) > $length) {
        $text = substr($text, 0, $length - 1).'&hellip;';
    }

    return $text;
}
