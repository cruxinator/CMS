<div class="row">
    <ol class="breadcrumb">
        <li><a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/blog') !!}">Blog</a></li>

            {!! Cabin::breadcrumbs($location) !!}

        <li class="active"></li>
    </ol>
</div>