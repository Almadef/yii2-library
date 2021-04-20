<?php

namespace console\controllers;

use common\helpers\StorageHelper;
use common\models\{
    Author,
    Category,
    Publisher,
    Book,
    Storage
};
use Exception;
use Throwable;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use Faker\Factory;

/**
 * Seed database
 * @package console\controllers
 */
final class SeedController extends Controller
{
    private const COUNT_AUTHORS = 15;
    private const COUNT_CATEGORIES = 10;
    private const COUNT_PUBLISHERS = 6;
    private const COUNT_BOOKS = 40;

    /**
     * Create authors, categories, publishers, books.
     * @throws Exception
     */
    public function actionLibrary()
    {
        $faker = Factory::create();

        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            $authors = [];
            $categories = [];
            $publishers = [];

            for ($i = 0; $i < self::COUNT_AUTHORS; $i++) {
                $author = new Author();
                $author->name_ru = $faker->name;
                $author->name_en = $faker->name;
                $author->surname_ru = $faker->lastName;
                $author->surname_en = $faker->lastName;
                $author->patronymic_ru = $faker->name;
                $author->patronymic_en = $faker->name;
                $author->save();
                $authors[] = $author;
            }

            for ($i = 0; $i < self::COUNT_CATEGORIES; $i++) {
                $category = new Category();
                $category->title_ru = $faker->word;
                $category->title_en = $faker->word;
                $category->save();
                $categories[] = $category;
            }

            for ($i = 0; $i < self::COUNT_PUBLISHERS; $i++) {
                $publisher = new Publisher();
                $publisher->name_ru = $faker->company;
                $publisher->name_en = $faker->company;
                $publisher->save();
                $publishers[] = $publisher;
            }

            for ($i = 0; $i < self::COUNT_BOOKS; $i++) {
                $book = new Book();
                $book->title_ru = $faker->word;
                $book->title_en = $faker->word;
                $book->release = $faker->date();
                $book->isbn = $faker->isbn13;
                $book->pages = $faker->randomDigitNotNull;
                $book->description_ru = $faker->text(700);
                $book->description_en = $faker->text(700);
                $book->link('publisher', $publishers[$this->getRandomNumberForArray(self::COUNT_PUBLISHERS)]);
                $book->save();

                $usedAuthors = [];
                for ($j = 0; $j < rand(1, 3); $j++) {
                    $authorNumber = $this->getNewObjectNumber($usedAuthors, self::COUNT_AUTHORS);
                    $usedAuthors[] = $authorNumber;
                    $book->link('authors', $authors[$authorNumber], ['created_at' => time()]);
                }

                $usedCategories = [];
                for ($j = 0; $j < rand(1, 2); $j++) {
                    $categoryNumber = $this->getNewObjectNumber($usedCategories, self::COUNT_CATEGORIES);
                    $usedCategories[] = $categoryNumber;
                    $book->link('categories', $categories[$categoryNumber], ['created_at' => time()]);
                }

                $bookFile = new Storage();
                $bookFile->model_id = $book->id;
                $bookFile->model_name = Book::class;
                $bookFile->description = StorageHelper::BOOK_BOOK_DESCRIPTION;
                $bookFile->file_name = $faker->word . '.pdf';
                $bookFile->file_type = 'pdf';
                $bookFile->file_size = 133668;
                $bookFile->file_path = '/seed/book.pdf';
                $bookFile->save();

                $coverFile = new Storage();
                $coverFile->model_id = $book->id;
                $coverFile->model_name = Book::class;
                $coverFile->description = StorageHelper::BOOK_COVER_DESCRIPTION;
                $coverFile->file_name = $faker->word . '.png';
                $coverFile->file_type = 'png';
                $coverFile->file_size = 433668;
                $coverFile->file_path = '/seed/book_cover.png';
                $coverFile->save();
            }

            $transaction->commit();
            $this->stdout(
                $this->ansiFormat('Success!' . PHP_EOL, Console::FG_GREEN)
            );
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (Throwable $e) {
            $transaction->rollBack();
        }
    }

    /**
     * @param array $numbers
     * @param int $count
     * @return int
     */
    private function getNewObjectNumber(array $numbers, int $count): int
    {
        while (true) {
            $number = $this->getRandomNumberForArray($count);
            if (!in_array($number, $numbers)) {
                return $number;
            }
        }
    }

    /**
     * @param int $count
     * @return int
     */
    private function getRandomNumberForArray(int $count): int
    {
        return rand(0, ($count - 1));
    }
}
