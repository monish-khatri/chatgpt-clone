<?php
function formatChatResponse($response)
{
    // Surround the string with <p> tags
    $response = '<p>' . $response . '</p>';

    // Wrap the PHP code in <pre> and <code> tags
    $response = addCodeTag($response);
    $response = preg_replace('/`(.+?)`/', '<strong>$1</strong>', $response);
    $response = preg_replace('/<!DOCTYPE.*?>/', '', $response);
    $response = preg_replace('/<html.*?>/', '', $response);
    $response = preg_replace('/<head.*?>/', '', $response);
    $response = preg_replace('/<\/head>/', '', $response);
    $response = preg_replace('/<body.*?>/', '', $response);
    $response = preg_replace('/<\/body>/', '', $response);
    $response = preg_replace('/<\/html>/', '', $response);
    /*  $response = preg_replace('/\t/', '', $response); */
    $response = preg_replace('/\n\s*\n/', "\n", $response);


    return $response;
}

function addCodeTag($response)
{
    $pattern = '/```(.*?)```/s';
    $replacement = '<pre class="program-response"><code>$1</code></pre>';
    return preg_replace($pattern, $replacement, $response);
}

