<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <style type="text/css">
        /*Start Jobs lists */
        .media {
            border-bottom: 1px solid #f9f9f9;
            padding-bottom: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .media-title {
            margin-top: 0;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 15px;
            color: #34395e;
        }

        .text-time {
            font-size: 12px;
            color: #666;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .media-description {
            line-height: 24px;
        }

        .media-links {
            margin-top: 10px;
        }

        .media-body {
            margin-left: 10px;
        }

        /*End jobs lists*/
        .table-class {
            width: 100%;
            max-width: 570px;
            margin: auto;
            box-shadow: 0 2px 0 rgb(0 0 150 / 3%), 2px 4px 0 rgb(0 0 150 / 2%);
            padding: 30px;
        }

        .main-logo {
            width: 100px;
            height: auto;
            margin: 10px auto 20px;
            display: block;
        }

        .text-blue-color {
            color: #6777ef;
        }

        .company-name {
            background: none !important;
            text-decoration: underline !important;
            padding: 0 !important;
            margin-top: -5px !important;
            min-width: unset !important;
            color: #6777ef !important;
        }
    </style>
</head>
<body style="background-color: #edf2f7">
<div style=" border-radius: 5px; padding: 15px; margin: 50px auto; width: 100%;">
    <table class="table-class" style="background-color: #fff;">
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td>
                            <img style="text-align: center;" src='{{ getLogoUrl() }}'
                                 alt="company logo"
                                 class="img-fluid main-logo">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td>
                            {!! $data['body'] !!}
                            @foreach($data['jobs'] as $key => $job)
                                <li class="media">
                                    <img alt="image" class="mr-3 rounded-circle" width="70"
                                         src="{{$job->company->company_url}}">
                                    <div class="media-body">
                                        <a class="media-title mb-1"
                                           href="{{ route('front.job.details', $job->job_id) }}">{{ $job->job_title }}</a>
                                        <div class="text-time">{{ $job->created_at->diffForHumans() }}</div>
                                        <div class="media-description text-muted">{!! html_entity_decode($job->description) !!}</div>
                                        <div class="media-links">
                                            <span>Expiry Date: {{ \Carbon\Carbon::parse($job->job_expiry_date)->format('d-m-Y') }}</span>
                                        </div>
                                    </div>
                                </li>
                                @if ($key + 1 != count($data['jobs']))
                                    <hr>
                                @endif
                            @endforeach
                            {!! $data['footer'] !!}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td>
                            <p style="margin-bottom: 0;text-align: center; font-size: 13px;">
                                <strong>&copy;2021 <a href="{{ config('app.url') }}"
                                                      class="company-name">{{ config('app.name') }}</a>.</strong>
                                All rights reserved.
                            </p>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
