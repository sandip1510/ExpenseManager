namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    public function export()
    {
        $expenses = Expense::where('user_id', auth()->id())->get();
        $csvFileName = 'expenses.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Expires" => "0"
        ];

        $columns = ['Title', 'Amount', 'Date', 'Description'];

        $callback = function() use ($expenses, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($expenses as $expense) {
                fputcsv($file, [
                    $expense->title,
                    $expense->amount,
                    $expense->date,
                    $expense->description,
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
