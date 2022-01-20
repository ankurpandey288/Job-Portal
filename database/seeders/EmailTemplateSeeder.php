<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

/**
 * Class EmailTemplateSeeder
 */
class EmailTemplateSeeder extends Seeder
{
    public function run()
    {
        $emailTemplates = [
            [
                'template_name' => 'Job Notification',
                'subject'       => 'New Job Notification',
                'body'          => '<div style="text-align: left;" class="text-blue-color">
                                <strong>Hi {{candidate_name}},</strong>
                            </div>
                            <br/>
                            Notification of all Job opportunities updated on {{date}} in <a target="_blank" href="{{app_url}}">{{from_name}}</a>
                            <br/><br>
                            {{jobs}}
                            <strong style="display: block; margin-top: 15px;" class="text-blue-color">Regards, <br/>
                                {{from_name}}
                            </strong>',
                'variables'     => '{{candidate_name}}, {{app_url}}, {{from_name}}',
            ],
            [
                'template_name' => 'Contact Us',
                'subject'       => 'Thanks For Contacting',
                'body'          => ' <div style="text-align: left;" class="text-blue-color">
                                <strong>Hello! {{name}},</strong>
                            </div>
                            <br/>
                            Thanks for contacting us.
                            <br/><br>
                            Quaerat facere dicta<br/><br>
                            Apart from the email, you can also contact me on my cell : {{phone_no}}<br><br>
                            <strong style="display: block; margin-top: 15px;" class="text-blue-color">Regards, <br/>
                                {{from_name}}
                            </strong>',
                'variables'     => '{{name}}, {{phone_no}}, {{from_name}}',
            ],
            [
                'template_name' => 'News Letter',
                'subject'       => '',
                'body'          => '<div style="text-align: left;" class="text-blue-color">
                                <strong>Hello Dear,</strong>
                            </div>
                            <br/>
                            New Notice from {{from_name}}. <br/><br>
                            {{description}}<br><br>
                            <strong style="display: block; margin-top: 15px;" class="text-blue-color">Regards, <br/>
                                {{from_name}}
                            </strong>',
                'variables'     => '{{description}}, {{from_name}}',
            ],
            [
                'template_name' => 'Email Job To Friend',
                'subject'       => 'Email for Job Details',
                'body'          => ' <div style="text-align: left;" class="text-blue-color">
                                <strong>Hi {{friend_name}},</strong>
                            </div>
                            <br/>
                            I have send you the below job link in which you can find the relevant details for the same.
                            <br/><br>
                                Link : <a href="{{job_url}}" target="_blank">{{job_url}}</a>
                            <br><br>
                            <strong style="display: block; margin-top: 15px;" class="text-blue-color">Regards, <br/>
                                {{from_name}}
                            </strong>',
                'variables'     => '{{friend_name}}, {{job_url}}, {{from_name}}',
            ],
            [
                'template_name' => 'Job Alert',
                'subject'       => 'New Job Alert',
                'body'          => '<div style="text-align: left;" class="text-blue-color">
                                <strong>Hi {{job_name}},</strong>
                            </div>
                            <br/>
                            <h2>Job Title: {{job_title}}</h2>
                            <br/><br>
                            New job posted with {{job_title}}, if you are interested then you can apply for this job.<br><br>
                            <div style="display: flex; justify-content: center;width: 100%;">
                                <a href="{{job_url}}" target="_blank">View Job</a>
                            </div<br><br>
                            <strong style="display: block; margin-top: 15px;" class="text-blue-color">Thanks, <br/>
                                {{from_name}}
                            </strong>',
                'variables'     => '{{job_name}},{{job_url}}, {{job_title}}, {{from_name}}',
            ],
            [
                'template_name' => 'Candidate Job Applied',
                'subject'       => 'Job Applied by Candidate',
                'body'          => '<div style="text-align: left;" class="text-blue-color">
                                <strong>Hi {{employer_fullName}},</strong>
                            </div>
                            <br/>
                            <h2>Someone just applied for job : {{job_title}}</h2>
                            <br/><br>
                            My name is {{candidate_name}}<br><br>
                            I have go through with your job details and thereby i have applied for the same. Please kindly contact me if i found suitable based on your needs.<br><br>
                            <div style="display: flex; justify-content: center;width: 100%;">
                                <a href="{{candidate_details_url}}" target="_blank">View Candidate Profile</a>
                            </div>
                            <br><br>
                            <strong style="display: block; margin-top: 15px;" class="text-blue-color">Regards, <br/>
                                {{from_name}}
                            </strong>',
                'variables'     => '{{employer_fullName}},{{candidate_name}},{{candidate_details_url}}, {{job_title}}, {{from_name}}',
            ],
            [
                'template_name' => 'Verify Email',
                'subject'       => 'Verify Email Address',
                'body'          => '<div style="text-align: left;" class="text-blue-color">
                                <strong>Hello! {{user_name}},</strong>
                            </div>
                            <br/>
                            Please click the button below to verify your email address.
                            <br/><br>
                            <div style="display: flex; justify-content: center;width: 100%;">
                                <a href="{{verify_url}}">Verify Email Address</a>
                            </div>
                            <br><br>
                            If you did not create an account, no further action is required.<br><br>
                            <strong style="display: block; margin-top: 15px;" class="text-blue-color">Regards, <br/>
                                {{from_name}}
                            </strong>',
                'variables'     => '{{user_name}},{{verify_url}},{{from_name}}',
            ],
            [
                'template_name' => 'Password Reset Email',
                'subject'       => 'Reset Password Notification',
                'body'          => '<div style="text-align: left;" class="text-blue-color">
                                <strong>Hello!,</strong>
                            </div>
                            <br/>
                            You are receiving this email because we received a password reset request for your account.
                            <br/><br>
                            <div style="display: flex; justify-content: center;width: 100%;">
                                <a href="{{reset_url}}">Reset Password</a>
                            </div>
                            <br><br>
                            This password reset link will expire in 60 minutes.<br><br>
                            If you did not request a password reset, no further action is required.<br><br>
                            <strong style="display: block; margin-top: 15px;" class="text-blue-color">Regards, <br/>
                                {{from_name}}
                            </strong>
                            ',
                'variables'     => '{{reset_url}},{{from_name}}',
            ],
        ];

        foreach ($emailTemplates as $emailTemplate) {
            EmailTemplate::create($emailTemplate);
        }
    }
}
