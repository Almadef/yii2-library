<?php

namespace frontend\controllers;

use common\models\Book;
use common\models\Category;
use common\models\IdxLibrary;
use common\models\UserBook;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

/**
 * LibraryController controller
 */
final class LibraryController extends Controller
{
     /**
     * Displays homepage.
     *
     * @param string|null $search
     * @param int|null $category_id
     * @param int|null $author_id
     * @param int|null $publisher_id
     * @return mixed
     */
    public function actionIndex(
        string $search = null,
        int $category_id = null,
        int $author_id = null,
        int $publisher_id = null
    ) {
        $queryBook = Book::find()
            ->isNoDeleted();

        if (isset($search)) {
            $idsBook = IdxLibrary::search($search);
            $queryBook->byId($idsBook);
        }
        if (isset($category_id)) {
            $queryBook->joinWith('categories');
            $queryBook->andWhere(['{{%category}}.id' => $category_id]);
        }
        if (isset($author_id)) {
            $queryBook->joinWith('authors');
            $queryBook->andWhere(['{{%author}}.id' => $author_id]);
        }
        if (isset($publisher_id)) {
            $queryBook->joinWith('publisher');
            $queryBook->andWhere(['{{%publisher}}.id' => $publisher_id]);
        }

        $pages = new Pagination(['totalCount' => $queryBook->count(), 'pageSize' => 8]);
        $books = $queryBook->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $categories = Category::find()
            ->isNoDeleted()
            ->all();

        return $this->render('index', [
            'pages' => $pages,
            'books' => $books,
            'categories' => $categories,
        ]);
    }

    /**
     * Displays book.
     *
     * @param int $book_id
     * @return mixed
     */
    public function actionBook(int $book_id)
    {
        $book = Book::find()
            ->isNoDeleted()
            ->byId($book_id)
            ->one();

        $categories = Category::find()
            ->isNoDeleted()
            ->all();

        $fvBtn['is'] = UserBook::find()
            ->byBookId($book_id)
            ->byUserId(Yii::$app->user->id)
            ->exists();
        $fvBtn['lng'] = Yii::$app->language;

        return $this->render('book', [
            'book' => $book,
            'categories' => $categories,
            'fvBtn' => $fvBtn,
        ]);
    }
}
