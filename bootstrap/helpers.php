<?php

// 将路由名称转换为 CSS 类名
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

// 根据内容自动摘录 (SEO)
function make_excerpt($value, $length = '200')
{
    $excerpt = preg_replace('/\r\n|\r|\n+/', ' ', $value);

    return str_limit($excerpt, $length);
}
