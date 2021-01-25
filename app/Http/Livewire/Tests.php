<?php

namespace App\Http\Livewire;

use App\Models\Test;
use Livewire\Component;

class Tests extends Component
{

    public $contacts, $name, $phone, $contact_id;

    public $updateMode = false;

    public $inputs = [];

    public $i = 1;

      

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function add($i)

    {

        $i = $i + 1;

        $this->i = $i;

        array_push($this->inputs ,$i);

    }

      

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function remove($i)

    {

        unset($this->inputs[$i]);

    }

      

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function render()

    {

        $this->contacts = Test::all();

        return view('livewire.tests');

    }

      

    /**

     * Write code on Method

     *

     * @return response()

     */

    private function resetInputFields(){

        $this->name = '';

        $this->phone = '';

    }

      

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function store()

    {

        $validatedDate = $this->validate([

                'name.0' => 'required',

                'phone.0' => 'required',

                'name.*' => 'required',

                'phone.*' => 'required',

            ],

            [

                'name.0.required' => 'name field is required',

                'phone.0.required' => 'phone field is required',

                'name.*.required' => 'name field is required',

                'phone.*.required' => 'phone field is required',

            ]

        );

   

        foreach ($this->name as $key => $value) {

            Test::create(['name' => $this->name[$key], 'phone' => $this->phone[$key]]);

        }

  

        $this->inputs = [];

   

        $this->resetInputFields();

   

        session()->flash('message', 'Contact Has Been Created Successfully.');

    }

}
