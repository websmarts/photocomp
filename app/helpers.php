<?php
define('CLEAN_STRING', "/[^a-zA-Z0-9 ]+/"); // regex for alpha-numeric only

function flash($message)
{
    session()->flash('message', $message);
}

function category_section_options($categories)
{
    $html = '';

    foreach ($categories as $cat) {
        foreach ($cat['sections'] as $sec) {
            $html .= '<option value="' .
                $sec['category_id'] . '_' .
                $sec['id'] . '">' .
                $cat['name'] . ': ' .
                $sec['name'] . '</option>';

        }
    }
    return $html;
}

function linkRouteIf($linktext, $route, $condition)
{
    if ($condition) {
        return '<a href="' . route($route) . '">' . $linktext . '</a>';
    } else {
        return $linktext;
    }

}

function clean_string($s)
{
    return preg_replace(CLEAN_STRING, "", $s);
}

function user_section_photos($user, $section)
{
    return $user->photos->filter(function ($photo) use ($section) {
        return $photo->section_id == $section->id;
    })->sortBy('section_entry_number');
}
