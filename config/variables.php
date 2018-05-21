<?php
/**
 * Created by PhpStorm.
 * User: Elanganathapillai
 * Date: 14/09/2016
 * Time: 20:08
 */

return [
    /*Company name and */
    'paginate_count' => '20',
    'company_name' => 'Global City Media',
    'product_name' => 'Global City Media',

    'tel' => '+44 (0) 20 7193 5801',
    'address' => '',

    'archive_datetime' => date_format(new DateTime('+730 Days'), 'Y-m-d\TH:i'),
    'renewal_datetime' => date_format(new DateTime('+730 Days'), 'Y-m-d\TH:i'),
    'current_datetime' => date_format(new DateTime(), 'Y-m-d\TH:i'),

    'scheduled_task_status' => [
        '0' => 'Please select',
        '1' => 'Scheduled',
        '2' => 'Sent'
    ],

    'userstatus' => [
        0 => 'Please select',
        1 => 'Live',
        2 => 'Pending',
        3 => 'Pending: New member',
        4 => 'Archived',
        5 => 'Deleted'
    ],


    'status' => [
        '0' => 'Please select',
        '2' => 'Pending',
        '1' => 'Live',
        '3' => 'Archive',
    ],


    'post_types' => [
        '0' => 'Please select',
        '1' => 'Page',
    ],


    'post_types_url' => [
        '' => '',
        '' => '',
    ],


    'twitter' => 'https://twitter.com/',
    'linkedin' => 'https://www.linkedin.com/company/',
    'instagram' => 'https://www.instagram.com/',

    'websites' => [
        '' => 'Please select',
        'no_website' =>'Do not show on any website',
        'globallegalpost' =>'Global Legal Post',
        'roboticslawjournal' =>'Robotics Law Journal',
        'luxurylawalliance' =>'Luxury Law Alliance',
        'all_websites' =>'Show on all websites',
    ],

    'contact_list_types' => [
        '' => 'Please select',
        'permanent' =>'Permanent',
        'flex' =>'Flex'
    ],

    'countries' => [
        '' => 'Please select',
        'afghanistan'=>'Afghanistan',
        'albania'=> 'Albania',
        'algeria'=> 'Algeria'
    ],
    
'job_titles' => [
    '0' => 'Please select',
    '1' => 'Private practice law firm',
    '2' => 'Company in house legal department',
    '3' => 'Outsourcing company',
    '4' => 'Public sector/Government',
    '5' => 'Marketing/advertising agency',
    '6' => 'Recruitment consultant',
    '7' => 'Other',
]   

];