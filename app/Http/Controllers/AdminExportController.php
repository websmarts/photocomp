<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class AdminExportController extends Controller
{

    public function exportcsv()
    {

        $sql = '
            SELECT
            a.*,
            p.*,
            u.`email`,
            s.name AS section_name,
            c.name AS category_name

            FROM applications a

            JOIN users u ON u.id = a.user_id
            JOIN photos p ON p.user_id = a.user_id
            JOIN sections s ON p.section_id = s.`id`
            JOIN categories c ON p.category_id = c.`id`
            WHERE a.payment_method = "paypal"
            ORDER BY a.id ASC
        ';

        // Added WHERE payment_method = paypal after 2020 season to
        // ensure exported entries have at least tried to pay!

        $results = DB::select($sql);

        $columns = [

            'entrant_id',
            'salutation',
            'firstname',
            'lastname',
            'honours',
            'address1',
            'address2',
            'city',
            'postcode',
            'state',
            'country',
            'phone',
            'vaps_affiliated',
            'aps_member',
            'aps_membership_number',
            'club_nomination',
            'confirm_terms',
            'number_of_entries',
            'number_of_sections',
            'return_postage',
            'return_post_option',
            'entries_cost',
            'submitted',
            'payment_method',
            'mc_gross',
            'mc_gross_1',
            'mc_gross_2',
            'mc_fee',
            'txn_id',
            'payment_date',
            'notes',
            'created_at',
            'updated_at',
            'category_id',
            'section_id',
            'title',
            'filepath',
            'filesize',
            'width',
            'height',
            'section_entry_number',
            'export_filename',
            'exported',
            'section_name',
            'category_name',
            'email',
            'where_hear',
            'return_group'
        ];
        $items = [];

        foreach ($results as $r) {
            $item = [];
            foreach ($columns as $c) {
                if ($c == 'entrant_id') {
                    $item[$c] = $r->user_id + 1000;
                } else {
                    $item[$c] = $r->$c;
                }

            }
            $items[] = $item;
        }

        $filename = "photodb_csv_" . gmdate("dmY") . ".csv";

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=" . $filename,
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        );

        $callback = function () use ($items, $columns) {
            //dd($items);
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($items as $item) {
    
                fputcsv($file, $item);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

}
