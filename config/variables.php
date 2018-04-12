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
    'product_name' => 'GLP Mail',

    'tel' => '+44 (0) 20 7193 5801',
    'address' => '',

    'archive_datetime' => date_format(new DateTime('+730 Days'), 'Y-m-d\TH:i'),
    'current_datetime' => date_format(new DateTime(), 'Y-m-d\TH:i'),


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


];