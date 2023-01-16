<?php

namespace App\Http\Controllers;
ini_set('max_execution_time', 300000);
use App\Exports\ExcelExport;
use Goutte\Client;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CrawlerController extends Controller
{
    public $crawler;
    public $count = 1;
    public $line = 1;
    public $arr = [];


    public function __invoke(Request $request)
    {

        $validate = $request->validate([
            'url' => 'required|url',
            'title' => 'required',
        ]);
        if($request->has('page') && $request->page ==!null){
            $url = $request->url.$this->count;
        } else {
            $url = $request->url;
        }
        $this->crawler = self::Connection($url);

        $title = $this->getTitle($request->title);
        $price = $this->getPrice($request->price);
        $filter = $this->filter($title, $request->filter);

        foreach ($filter as $key => $value) {
            $this->arr[] = [
                'title' => $value ?? null,
                'price' => $price[$key] ?? null,
            ];
        }

        if($request->has('page') && $request->page ==!null) {
            if($this->count < $request->page) {
            $this->count++;
            return $this->__invoke($request);
            }
        } 
        if($request->has('excel')){
            return Excel::download(new ExcelExport($this->arr), 'data.xlsx');
        }
        return view('index')->with('arr', $this->arr);


    }

    protected static function Connection($url)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);

        return $crawler;
    }

    protected function getTitle($class)
    {
        $title = [];
        $this->crawler->filter($class)->each(function ($node) use (&$title) {
            $title[] = $node->text();
        });

        return $title;
    }

    protected function getPrice($class)
    {
        $price = [];
        $this->crawler->filter($class)->each(function ($node) use (&$price) {
            $price[] = $node->text();
        });

        return $price;
    }

    protected function filter($arr,$word='')
    {
        $filter = array_filter($arr, function ($w) use ($word) {
            return stripos($w, $word) !== false;
        });

        return $filter;
    }
}
