<?php
namespace App\Helpers;

class M
{
    static function flash($message, $status='info')
    {
        session()->flash("issue_status", $status);
        session()->flash("issue_message", $message);
    }

}


?>
