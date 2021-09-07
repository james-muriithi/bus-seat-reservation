<?php

namespace App\Helpers\FPDF;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use LaravelQRCode\Facades\QRCode;

class MyPdf extends exFPDF
{
    public function __construct($orientation = 'P', $unit = 'mm', $size = 'A4')
    {
        parent::__construct($orientation, $unit, $size);
        $this->addFonts();
    }

    public function addFonts(): void
    {
        $this->AddFont('bahaus', '', 'bauhausregular.php');
        $this->AddFont('coves', '', 'Coves-Bold.php');
        $this->AddFont('covesl', '', 'Coves-Light.php');
        $this->AddFont('aquatico', '', 'Aquatico-Regular.php');
        $this->AddFont('moonb', '', 'Moon-Bold.php');
        $this->AddFont('moonl', '', 'Moon-Light.php');
    }

    public function addLogo($company, $image = ''): void
    {
        $this->SetFont('moonb', '', 18);
        $this->setTextColor(255, 255, 255);
        $this->image(public_path('images/bus2.png'), 10, 6, 15, 15);

        $this->setXY(32, 7);
        $this->Cell(19, 12, $company, 0, 0, "R");

        $this->setXY($this->GetPageWidth() - 30, 8);
        $this->Cell(19, 12, "Boarding Pass", 0, 0, "R");
    }

    public function addBody(
        $passenger,
        $from,
        $to,
        $ticket_no,
        $travel_date,
        $departure,
        $fare,
        $seat_number
    ) {
        $y = 26;
        $x = 10;

        $this->SetFillColor(255, 255, 255);
        $this->Rect($x - 5, $y - 2, $this->GetPageWidth() - 10,    $this->getPageHeight() - 35, 'F');

        // passenger
        $this->setXY($x + 5, $y - 3);
        $this->SetFont('Helvetica', '', 11);
        $this->setTextColor(148, 148, 148);
        $this->Cell(19, 12, "Passenger Name", 0, 0, "C");

        $this->setXY($x + 3, $y + 3);
        $this->SetFontSize(12);
        $this->setTextColor(70, 70, 70);
        $this->Cell(19, 12, $passenger, 0, 0, "C");

        // From
        $this->setXY($x - 1, $this->GetY() + 8);
        $this->SetFontSize(11);
        $this->setTextColor(148, 148, 148);
        $this->Cell(25, 12, "From", 0, 0, "L");

        $this->setXY($x - 2, $this->GetY() + 6);
        $this->SetFontSize(12);
        $this->setTextColor(70, 70, 70);
        $this->Cell(25, 12, $from, 0, 0, "L");

        // To
        $this->setXY($x - 1, $this->GetY() + 8);
        $this->SetFontSize(11);
        $this->setTextColor(148, 148, 148);
        $this->Cell(25, 12, "To", 0, 0, "L");

        $this->setXY($x - 2, $this->GetY() + 6);
        $this->SetFontSize(12);
        $this->setTextColor(70, 70, 70);
        $this->Cell(25, 12, $to, 0, 0, "L");

        // Ticket Number
        $this->setXY($x - 1, $this->GetY() + 8);
        $this->SetFontSize(11);
        $this->setTextColor(148, 148, 148);
        $this->Cell(25, 12, "Ticket #", 0, 0, "L");

        $this->setXY($x - 2, $this->GetY() + 6);
        $this->SetFontSize(12);
        $this->setTextColor(70, 70, 70);
        $this->Cell(25, 12, $ticket_no, 0, 0, "L");


        // column 2
        // Date
        $x = $x + 45;
        $this->setXY($x, $y + 11);
        $this->SetFontSize(11);
        $this->setTextColor(148, 148, 148);
        $this->Cell(25, 12, "Date", 0, 0, "L");

        $this->setXY($x, $y + 18);
        $this->SetFontSize(12);
        $this->setTextColor(70, 70, 70);
        $this->Cell(25, 12, $travel_date, 0, 0, "L");

        // Departure
        $this->setXY($x, $this->GetY() + 8);
        $this->SetFontSize(11);
        $this->setTextColor(148, 148, 148);
        $this->Cell(25, 12, "Arrival Time", 0, 0, "L");

        $arrival_time = Carbon::parse($departure)->subMinutes(30)->format("g:i A");

        $this->setXY($x, $this->GetY() + 6);
        $this->SetFontSize(13);
        $this->setTextColor(70, 70, 70);
        $this->Cell(25, 12, $arrival_time, 0, 0, "L");

        // Seat Number
        $this->setXY($x, $this->GetY() + 8);
        $this->SetFontSize(11);
        $this->setTextColor(148, 148, 148);
        $this->Cell(25, 12, "Seat No", 0, 0, "L");

        $this->setXY($x, $this->GetY() + 6);
        $this->SetFontSize(13);
        $this->setTextColor(70, 70, 70);
        $this->Cell(25, 12, $seat_number, 0, 0, "L");


        // column 3
        // Fare
        $x = $this->GetX() + 23;
        $this->setXY($x, $y + 11);
        $this->SetFontSize(11);
        $this->setTextColor(148, 148, 148);
        $this->Cell(25, 12, "Fare", 0, 0, "L");

        $this->setXY($x, $y + 18);
        $this->SetFontSize(12);
        $this->setTextColor(70, 70, 70);
        $this->Cell(25, 12, $fare, 0, 0, "L");

        // Departure Time
        $this->setXY($x, $this->GetY() + 8);
        $this->SetFontSize(11);
        $this->setTextColor(148, 148, 148);
        $this->Cell(25, 12, "Departure Time", 0, 0, "L");

        $this->setXY($x, $this->GetY() + 6);
        $this->SetFontSize(12);
        $this->setTextColor(70, 70, 70);
        $this->Cell(25, 12, Carbon::parse($departure)->format('g:i A'), 0, 0, "L");


        // column 4
        // QR
        $this->generateQR($ticket_no);
    }

    public function addHeader($company = "My Bus")
    {
        // header
        $this->SetFillColor(18, 24, 99);
        $this->RoundedRect(5, 3, $this->GetPageWidth() - 10, 20, '5', '12', 'F');
        $this->addLogo($company);
    }

    public function addFooter()
    {
        $this->SetFillColor(18, 24, 99);
        $this->RoundedRect(5, $this->GetPageHeight() - 13, $this->GetPageWidth() - 10, 10, '5', '34', 'F');

        $this->SetFont('moonb', '', 11);
        $this->setTextColor(255, 255, 255);
        $this->image(public_path('images/bus2.png'), $this->GetPageWidth() - 15, $this->GetPageHeight() - 12, 7, 7);


        $this->SetLineWidth(1);
        $this->setDrawColor(255, 255, 255);
        $this->line(5, $this->GetPageHeight() - 8, $this->GetPageWidth() - 18, $this->GetPageHeight() - 8);
    }

    public function generateQR($ticket_no): void
    {
        $codeContents = $ticket_no;
        // QRcode::png($codeContents, 'temp/james.png', QR_ECLEVEL_L, 3);

        if (!File::isDirectory(public_path('images/qrs/'))) {
            File::makeDirectory(public_path('images/qrs/'));
        }

        QRCode::text($codeContents)
            ->setOutfile(public_path("images/qrs/$ticket_no.png"))
            ->setSize(4)
            ->png();

        if (File::exists(public_path("images/qrs/$ticket_no.png"))) {
            $this->image(public_path("images/qrs/$ticket_no.png"), $this->GetPageWidth() - 50, 37, 41, 41);
        }
    }

    public function RoundedRect($x, $y, $w, $h, $r, $corners = '1234', $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if ($style == 'F')
            $op = 'f';
        elseif ($style == 'FD' || $style == 'DF')
            $op = 'B';
        else
            $op = 'S';
        $MyArc = 4 / 3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m', ($x + $r) * $k, ($hp - $y) * $k));

        $xc = $x + $w - $r;
        $yc = $y + $r;
        $this->_out(sprintf('%.2F %.2F l', $xc * $k, ($hp - $y) * $k));
        if (strpos($corners, '2') === false)
            $this->_out(sprintf('%.2F %.2F l', ($x + $w) * $k, ($hp - $y) * $k));
        else
            $this->_Arc($xc + $r * $MyArc, $yc - $r, $xc + $r, $yc - $r * $MyArc, $xc + $r, $yc);

        $xc = $x + $w - $r;
        $yc = $y + $h - $r;
        $this->_out(sprintf('%.2F %.2F l', ($x + $w) * $k, ($hp - $yc) * $k));
        if (strpos($corners, '3') === false)
            $this->_out(sprintf('%.2F %.2F l', ($x + $w) * $k, ($hp - ($y + $h)) * $k));
        else
            $this->_Arc($xc + $r, $yc + $r * $MyArc, $xc + $r * $MyArc, $yc + $r, $xc, $yc + $r);

        $xc = $x + $r;
        $yc = $y + $h - $r;
        $this->_out(sprintf('%.2F %.2F l', $xc * $k, ($hp - ($y + $h)) * $k));
        if (strpos($corners, '4') === false)
            $this->_out(sprintf('%.2F %.2F l', ($x) * $k, ($hp - ($y + $h)) * $k));
        else
            $this->_Arc($xc - $r * $MyArc, $yc + $r, $xc - $r, $yc + $r * $MyArc, $xc - $r, $yc);

        $xc = $x + $r;
        $yc = $y + $r;
        $this->_out(sprintf('%.2F %.2F l', ($x) * $k, ($hp - $yc) * $k));
        if (strpos($corners, '1') === false) {
            $this->_out(sprintf('%.2F %.2F l', ($x) * $k, ($hp - $y) * $k));
            $this->_out(sprintf('%.2F %.2F l', ($x + $r) * $k, ($hp - $y) * $k));
        } else
            $this->_Arc($xc - $r, $yc - $r * $MyArc, $xc - $r * $MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf(
            '%.2F %.2F %.2F %.2F %.2F %.2F c ',
            $x1 * $this->k,
            ($h - $y1) * $this->k,
            $x2 * $this->k,
            ($h - $y2) * $this->k,
            $x3 * $this->k,
            ($h - $y3) * $this->k
        ));
    }
}
