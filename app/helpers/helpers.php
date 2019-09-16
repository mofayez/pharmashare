<?php

use App\Mail\MailSender;

/**
 * return message...
 *
 * @param bool $status
 * @param string|null $msg
 * @param array $data
 * @return array|null
 */
function return_msg(bool $status = false, string $msg = null, array $data = []): ?array
{
    return ['status' => $status, 'msg' => $msg, 'data' => $data];
}

function send_email($data)
{

    Mail::to($data['to'])
        ->send(new MailSender($data['content'], $data['template']));

}