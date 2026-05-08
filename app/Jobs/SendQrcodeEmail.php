<?php

namespace App\Jobs;

use App\Mail\QrcodeInvite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\QrcodeInvite as ModelQrcodeInvite;

class SendQrcodeEmail implements ShouldQueue
{
    use Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $guardian) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $code = hash('sha256', $this->guardian->EMAIL . Str::uuid());
        $pdfPath = 'qrcodes/' . $this->guardian->EMAIL . '.pdf';

        // Salva código no banco de dados
        ModelQrcodeInvite::create([
            'user_id' => $this->guardian->id,
            'code' => $code
        ]);

        // Gera QR Code
        $qrCode = QrCode::create($code);
        $writer = new PngWriter();
        $qrCodeImage = $writer->write($qrCode);
        $qrCodeDataUri = $qrCodeImage->getDataUri();

        // Gera o PDF com o QR Code
        $pdf = Pdf::loadView('pdf.invite', [
            'qrCode' => $qrCodeDataUri
        ]);

        // Salva o PDF no armazenamento local
        Storage::disk('public')->put($pdfPath, $pdf->output());

        // Envia e-mail com o PDF anexado
        Mail::to($this->guardian->EMAIL)->send(new QrcodeInvite(
            $this->guardian->NOME,
            storage_path('app/public/' . $pdfPath)
        ));
    }
}
