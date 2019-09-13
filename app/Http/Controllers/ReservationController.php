<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Plan;


class ReservationController extends Controller
{

    public function __construct(){
        $this->middleware('admin')->except('index','store','reserve');
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reservations = Reservation::paginate(5);
        
        if($request->ajax()){
            $html = \View::make('reservation/reservationtable',compact('reservation'));
            return \Response::json($html->render());
        }

        return view('reservation/reservation',compact('reservations'));
    }

    public function export_pdf(){
        $reservations = Reservation::all();

        $pdf = \PDF::loadView('reservation/pdf',compact('reservations'));
        return $pdf->download("rezervacije.pdf");

    } 

    public function export_word(){
        $reservations = Reservation::all();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $phpWord->addTitleStyle(1,array("size"=>16,"align"=>"center"));
        $section->addTitle("Rezervacije");
        
        foreach($reservations as $reservation){
            $table = $section->addTable('cool table',array("borderSize"=>3, "borderColor"=>"006699",'cellMargin' => 80));
            $table->addRow();
            $table->addCell(1000,array('valign' => 'center'))->addText("ID: ");
            $table->addCell(2000,array('valign' => 'center'))->addText($reservation->id);
            $table->addCell(1000,array('valign' => 'center'))->addText("Ime: ");
            $table->addCell(2000,array('valign' => 'center'))->addText($reservation->user->firstname);
            $table->addCell(1000,array('valign' => 'center'))->addText("Prezime: ");
            $table->addCell(2000,array('valign' => 'center'))->addText($reservation->user->lastname);
            $table->addRow();
            $table->addCell(1000,array('valign' => 'center'))->addText("Od: ");
            $table->addCell(2000,array('valign' => 'center'))->addText($reservation->plan->city_from->name.", ".$reservation->start_location);
            $table->addCell(1000,array('valign' => 'center'))->addText("Do: ");
            $table->addCell(2000,array('valign' => 'center'))->addText($reservation->plan->city_to->name.", ".$reservation->destination);
            $table->addCell(1000,array('valign' => 'center'))->addText("Datum: ");
            $table->addCell(2000,array('valign' => 'center'))->addText($reservation->plan->date);
            $section->addTextBreak();
        }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('rezervacije.docx'));
        } catch (Exception $e) {
        }


        return response()->download(storage_path('rezervacije.docx'));
    }

    public function reserve($id){
        $plan = Plan::findOrFail($id);
        return view('reservation/reservationadd',compact('plan'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservation/reservationcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info(auth()->user()->firstname.' sa ID: '.auth()->user()->id.' je napravio novu rezervaciju');
        $data = $request->validate([
            'plan_id' => 'required',
            'start_location' => 'required',
            'destination' => 'required',
        ]);
        $pl = Plan::find($data['plan_id']);
        if($pl != null && $pl->space == 0){
            \Log::warning('Nema slobodnih mesta za rezervisanje');
            return "<div class='alert-danger py-4 text-center'>Nema vise slobodnih mesta!</div>";
        }
        
        //Proverava da li postoji rezervacija sa id plana i id usera
        if(Reservation::where("plan_id",$data['plan_id'])->where("user_id",auth()->user()->id)->exists()){
            \Log::warning(auth()->user()->firstname.' sa ID: '.auth()->user()->id.' pokusao istu rezervaciju da napravi');
            return "<div class='alert-warning py-4 text-center'>Vec ste rezervisali!</div>";
        }
        
        $reservation = new Reservation;
        $reservation->user_id = auth()->user()->id;
        $reservation->plan_id = $data['plan_id'];
        $reservation->destination = $data['destination'];
        $reservation->start_location = $data['start_location'];     
        $reservation->save();
        
        $plan = Plan::findOrFail($data['plan_id']);
        $plan->space =  $plan->space - 1;
        $plan->save();
        return "<div class='alert-success py-4 text-center'>Uspesno ste rezervisali!</div>";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $this->authorize('update',$reservation);
        return view('reservation/reservationupdate');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            
            'plan_id' => 'required',
            'street' => 'required',
            'start_location' => 'required',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->user_id = auth()->user()->id;
        $reservation->plan_id = $data['plan_id'];
        $reservation->destination = $data['street'];
        $reservation->start_location = $data['start_location'];     
        $reservation->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = Reservation::findOrFail($id);
        $plan->delete();
    }
}
