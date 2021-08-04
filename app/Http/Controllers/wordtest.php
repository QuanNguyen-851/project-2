<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class wordtest extends Controller
{
    public function wordtest()
    {
        $student = Student::findOrFail(1);
        $templateProcessor = new TemplateProcessor('word-templade/fee.docx');
        $templateProcessor->setValue('id', $student->id);
        $templateProcessor->setValue('name', $student->name);
        $templateProcessor->setValue('email', $student->email);
        $templateProcessor->setValue('address', $student->address);
        $fileName = $student->name;
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
}
