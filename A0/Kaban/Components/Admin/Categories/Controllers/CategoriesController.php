<?php


namespace Kaban\Components\Admin\Categories\Controllers;


use Illuminate\Http\Request;
use Kaban\Components\Admin\Categories\Resources\GetAllCategoriesResource;
use Kaban\Components\Admin\Categories\Resources\GetCategoryEditItemResource;
use Kaban\Components\Admin\Categories\Resources\SearchResource;
use Kaban\Core\Controllers\AdminBaseController;
use Kaban\General\Enums\EPostStatus;
use Kaban\Models\Category;
use Kaban\Models\Post;

class CategoriesController extends AdminBaseController {

    public function search( Request $request ) {


        $posts = Category::where( 'title', 'like', '%' . $request->val . '%' )->paginate( 10 );

        return SearchResource::collection( $posts );
    }

    public function edit( $id ) {
        $category = Category::findOrFail( $id );

        return new GetCategoryEditItemResource( $category );
    }

    public function all( Request $request ) {
        $sortType = 'DESC';
        $sortBy   = 'id';

        if ( ! empty( $request->sortBy[0] ) && in_array( $request->sortBy[0], [ 'id', 'title' ] ) ) {
            $sortBy = $request->sortBy[0];
        }
        if ( empty( $request->sortDesc[0] ) ) {
            $sortType = 'ASC';
        }

        $posts = Category::when( $request->search, function ( $q ) use ( $request ) {
            $q->where( 'title', 'like', "%$request->search%" );
        } )->orderBy( $sortBy, $sortType )->paginate( $request->itemsPerPage, [ '*' ], 'ascasc', $request->page );

        return GetAllCategoriesResource::collection( $posts );
//        return new GetAllPostsResource( $posts );
    }

    public function store( Request $request ) {
        $uid  = auth()->id();
        $item = Category::create( [
            'title'      => $request->title,
            'parent_id'  => $request->parent['value'],
            'author_id'  => $uid,
            'created_by' => $uid,
            'updated_by' => $uid,
            'status'     => EPostStatus::approved,
            'slug'       => slugify( $request->title )
        ] );

        return 'ok';
    }

    public function destroy( $id ) {
        Post::where( 'category_id', $id )->update( [ 'category_id' => null ] );
        $x = Category::query()->findOrFail( $id );

        return 'done';
    }

    public function update( Request $request ) {
        $uid      = auth()->id();
        $category = Category::find( $request->id );
//        dump( $category->descendants->pluck( 'id' )->toArray() );
//        if($category->des)
        if ( in_array( $request->parent, $category->descendants->pluck( 'id' )->toArray() ) ) {
            return response( [
                'errorMsg' => 'این دسته بندی پدر قبلا به عنوان فرزند انتخاب شده است. لطفا آن را تغییر دهید.'
            ] );
        }
        $category->update( [
            'title'     => $request->title,
            'parent_id' => $request->parent,
        ] );

        return 'done';
    }
}
