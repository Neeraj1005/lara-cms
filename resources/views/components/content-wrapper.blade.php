@props(['header' => ''])
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    {{ $header }}
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <x-cms::auth-session-status />
            {{ $slot }}
        </div>
    </section>
</div>
