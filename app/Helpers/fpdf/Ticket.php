<?php

namespace App\Helpers\FPDF;

class Ticket
{

    public $pdf;

    protected $pdfWidth = 105;
    protected $pdfHeight = 200;

    protected $passenger;
    protected $from;
    protected $to;
    protected $ticket_no;
    protected $travel_date;
    protected $departure;
    protected $fare;

    public function __construct()
    {

        $this->pdf = new MyPdf('L', 'mm', array($this->pdfWidth, $this->pdfHeight));
    }

    public function print(
        $passenger = "James Muriithi",
        $from = "Nairobi",
        $to = "Kilifi",
        $ticket_no = "TC-DI49949",
        $travel_date = "24th Aug 2021",
        $departure = "15:00:00",
        $fare = "1500",
        $seat_number
    ) {

        $this->passenger = $passenger;
        $this->from = $from;
        $this->to = $to;
        $this->travel_date = $travel_date;
        $this->ticket_no = $ticket_no;
        $this->departure = $departure;
        $this->fare = $fare;
        $this->seat_number = $seat_number;

        $this->pdf->AddPage();
        $this->pdf->SetAutoPageBreak(false);

        $this->pdf->SetFillColor(240, 240, 240);
        $this->pdf->Rect(0, 0, $this->pdf->getPageWidth(),    $this->pdf->getPageHeight(), 'F');


        $this->pdf->addHeader();

        $this->pdf->addBody(
            $this->passenger,
            $this->from,
            $this->to,
            $this->ticket_no,
            $this->travel_date,
            $this->departure,
            $this->fare,
            $this->seat_number,
        );

        // footer
        $this->pdf->addFooter();
    }

    public function save()
    {
        $this->pdf->Output('D', $this->passenger . '_' . $this->ticket_no . '.pdf');
    }
}
