<?php
$unreadCount = DB::table('notifications')
              ->where('etat', 'unread') // unread messages
              ->where('id_user', 2) // Auth::user()->id
              ->count();
?>

            @if ($unreadCount > 0)
            <span class="badge" style="background:red; position: relative; top: -15px; left:-33px">
                {{ $unreadCount }}
            </span>
            @endif
       
