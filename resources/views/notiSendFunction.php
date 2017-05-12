<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class notiSendFunction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    static public function notiMake_noPlace($senderuserPK,$recieveruserPK,$notificationKind)
    {
      DB::insert('insert into notification (senderuserPK,recieveruserPK,notificationKind,uploaddate) values
      (?,?,?,?,?)',[$senderuserPK,$recieveruserPK,$notificationKind,date("Y-m-d H:i:s")]);
      DB::update('update userinfo set eventCheck = eventCheck+1 where userPK = ?',[$recieveruserPK]);
    }

    static public function notiMake_Place($senderuserPK,$recieveruserPK,$notificationKind,$notificationPlace)
    {
      DB::insert('insert into notification (senderuserPK,recieveruserPK,notificationKind,notificationPlacePK
        ,uploaddate) values (?,?,?,?,?)',[$senderuserPK,$recieveruserPK,$notificationKind,$notificationPlace,date("Y-m-d H:i:s")]);
      DB::update('update userinfo set eventCheck = eventCheck+1 where userPK = ?',[$recieveruserPK]);
    }
}
