<section class="message-section">
    {foreach $messages as $type => $message}
        {foreach $message as $msg}
            <div class="alert alert-{$type}">{$msg}</div>
        {/foreach}
    {/foreach}
</section>
