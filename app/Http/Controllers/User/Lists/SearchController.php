<?php

namespace App\Http\Controllers\User\Lists;

use App\Models\Post\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = [];

        if ($query) {
            $results = array_merge(
                $this->searchModel(Post::class, 'post_title', 'post_content', $query, 'posts.show'),
                // $this->searchModel(Product::class, 'prod_name', 'prod_description', $query, 'products.show'),
                // $this->searchModel(Service::class, 'services_title', 'services_description', $query, 'services.show'),
                // $this->searchModel(Trade::class, 'trade_title', 'trade_description', $query, 'trades.show')
            );
        }

        if (empty($results)) {
            $results[] = [
                'title' => 'No results found',
                'description' => 'Try searching with different keywords.',
                'url' => '#',
            ];
        }

        return response()->json(['results' => $results]);
    }

    private function searchModel($model, $titleField, $descriptionField, $query, $routeName)
    {
        return $model::where($titleField, 'like', "%{$query}%")->get()->map(function ($item) use ($titleField, $descriptionField, $routeName) {
            return [
                'id' => $item->id,
                'title' => $item->$titleField,
                'description' => $item->$descriptionField,
                'url' => route($routeName, [$item->id]),
            ];
        })->toArray();
    }
}
