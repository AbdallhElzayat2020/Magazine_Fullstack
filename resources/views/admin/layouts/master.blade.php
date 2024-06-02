<!DOCTYPE html>
<html lang="en">

@include("admin.layouts.main-head")

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        @include("admin.layouts.main-header")
        @include("admin.layouts.main-sidebar")
        <!-- Main Content -->
        <div class="main-content">
            @yield("content")
        </div>
        @include("admin.layouts.footer")
    </div>
</div>

@include("admin.layouts.scripts")
</body>

</html>
