@extends('emails.master')

@section('content')
    <style>
        a {
            color: #ff3600;
        }
    </style>
    <td style="text-align: center; padding: 30px 0">
        <div style="color: #046493;">{!! __('site_labels.password_reset_email_with_reset_link', ['link' => $url]) !!}</div>
    </td>

@stop
