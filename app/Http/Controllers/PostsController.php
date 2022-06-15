<?php

namespace App\Http\Controllers;


use App\Models\Posts;

use Illuminate\Auth\Events\Failed;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request, $id=null)
    {
        if ($id) {
            $articles = Posts::where('id', $id)->first();
            $response = [
                'message' => 'List Post By ID',
                'data' => [
                    'article' => $articles,
                    // 'wishlist' => 
                ],
            ];
            return response()->json($response, Response::HTTP_OK);
        }else{
            try {
                
                
                $limit = $request->limit ? $request->limit : 10 ;
                $offset = $request->offset ? $request->offset : 0 ;
                // $start = $request->offset ? $offset/$limit : 0;

                $where = [];
                if ($request->status) $where['status'] = $request->status; 
                $keyword = $request->keyword;
                $order = 'created_date';
                $sort = 'DESC';
                if ($request->order_by) $order = $request->order_by; 
                if ($request->sort_by) $sort = $request->sort_by; 


                $articles = Posts::where($where)->orderBy($order, $sort);
                if ($keyword) {
                    $articles->Where(function($articles) use ($keyword){
                            // var_dump("$pattern");die;
                            $articles->Where('title', 'like', "%".$keyword."%");
                            $articles->orWhere('category', 'like', "%".$keyword."%");
                         });
                    
                }

                $articles->take($limit)->skip($offset);
                // $articles = Posts::where($where)->orderBy('created_date','DESC')->skip($offset)->take($limit)->get();
                $total = Posts::where($where)->orderBy($order)->get();

                $response = [
                    'message' => 'List All Posts',
                    'total' => count($total),
                    'data' => $articles->get(),
                    // 'where' => $where
                ];
                return response()->json($response, Response::HTTP_OK);
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Failed '.$e->errorInfo
                ]);   
            }
        }

    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'     => ['required','min:20','max:200'],
            'content'   => ['required','min:200'],
            'category'  => ['required','min:3'],
            'status'    => ['in:Publish,Draft,Trash', 'required']
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'errors' => $validator->errors()
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            Posts::insert($request->all());
            $response = [
                'status' => true,
                'message' => 'Successfully Added Article'
            ];
            return response()->json($response, Response::HTTP_OK);
            
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'errors' => 'Failed '.$e->errorInfo
            ]);   
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'     => ['required','min:20','max:200'],
            'content'   => ['required','min:200'],
            'category'  => ['required','min:3'],
            'status'    => ['in:Publish,Draft,Trash', 'required']
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'errors' => $validator->errors()
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            Posts::where('id', $id)->update($request->all());
            $response = [
                'status' => true,
                'message' => 'Successfully Updated Article'
            ];
            return response()->json($response, Response::HTTP_OK);
            
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'errors' => 'Failed '.$e->errorInfo
            ]);   
        }
    }

    function delete($id)
    {
        try {
            Posts::where('id', $id)->update(['status' => "Trash"]);
            $response = [
                'status' => true,
                'message' => 'Successfully Deleted Article'
            ];
            return response()->json($response, Response::HTTP_OK);
            
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'errors' => 'Failed '.$e->errorInfo
            ]); 
        }
    }
}
