@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
    @if ($level == 'error')
        # Whoops!
    @else
        # {{ __('site.hello') }}
    @endif
@endif

{{-- Intro Lines --}}
Hesabınız üçün şifrə yeniləmə tələbi aldığımız üçün bu e-poçtu alırsınız.



{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
Şifrə sıfırlama bağlantısı 60 dəqiqədən sonra başa çatacaqdır.

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('site.regards'),
{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
    {{ __('site.action',['actionText'=>'Yenilə','actionUrl'=>$actionUrl]) }}

@endslot
@endisset
@endcomponent
