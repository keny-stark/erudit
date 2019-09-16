<?php


namespace App\Parser\v2;


use Ammadeuss\LaravelHtmlDomParser\Facade as HtmlDomParser;
use App\Parser\ParseObject;
use App\Parser\ParserInterface;
use App\Parson;
use Illuminate\Support\Facades\Log;

class HtmlParser implements ParserInterface
{
    /**
     * @param $url
     * @param Parson $parson
     *
     * @return ParseObject|null
     */
    public function parse($url, Parson $parson)
    {
        Log::info('Searching for book in his page ... ');

        try {
            $html = file_get_contents($url);
        } catch (\ErrorException $e) {
            Log::info('Failed url in his page ... ');
            return null;
        }
        try {
            $html = HtmlDomParser::str_get_html($html);
        } catch (\ErrorException $exception) {
            Log::info('Failed url in his page ... ');
            return null;
        }

        if ($html == '') {
            Log::info('Failed url in his page ... ');
            return null;
        }

        Log::info('Found url in his page ... ');
        $parserObject = new ParseObject();

        if ($parson->name) {
            $name = $html->find($parson->name);
            if (count($name)) {
                if ($parson->name_count !== null) {
                    Log::info('Searching for book name in his page ... ');
                    $parserObject->setTitle($name[0]->nodes[$parson->name_count]->plaintext);
                    Log::info('Found book name in his page ... ');
                } else {
                    Log::info('Searching for book name in his page ... ');
                    $parserObject->setTitle($name[0]->plaintext);
                    Log::info('Found book name in his page ... ');
                }
            } else {
                Log::info('Not found book name in his page ... ');
                $parserObject->setTitle(null);
                return null;
            }
        }

        if ($parson->description) {
            $description = $html->find($parson->description);
            if (count($description)) {
                if ($parson->description_count) {
                    Log::info('Searching for book description in his page ... ');
                    $parserObject->setDescription($description[0]->nodes[$parson->description_count]->plaintext);
                    Log::info('Found book description in his page ... ');
                } else {
                    Log::info('Searching for book description in his page ... ');
                    $parserObject->setDescription($description[0]->plaintext);
                    Log::info('Found book description in his page ... ');
                }
            } else {
                Log::info('Not found book description in his page ... ');
                $parserObject->setDescription(null);
            }
        }

        if ($parson->image) {
            Log::info('Searching for book image in his page ... ');
            $image = $html->find($parson->image);
            if (count($image)) {
                $parserObject->setImage(isset($image[0]->attr['data-src']) ? $image[0]->attr['data-src'] : $image[0]->attr['src']);
                Log::info('Found book image in his page ... ');
            } else {
                $parserObject->setImage(null);
            }
        }

        if ($parson->isbn) {
            Log::info('Searching for book image in his page ... ');
            $isbn = $html->find($parson->isbn);
            if (count($isbn)) {
                if ($parson->description_count) {
                    Log::info('Searching for book description in his page ... ');
                    $parserObject->setIsbn($isbn[0]->nodes[$parson->description_count]->plaintext);
                    Log::info('Found book description in his page ... ');
                } else {
                    Log::info('Searching for book description in his page ... ');
                    $parserObject->setIsbn($isbn[0]->plaintext);
                    Log::info('Found book description in his page ... ');
                }
            } else {
                Log::info('Not found book description in his page ... ');
                $parserObject->setIsbn(null);
            }
        }

        if ($parson->genre) {
            Log::info('Searching for book image in his page ... ');
            $genre = $html->find($parson->genre);
            if (count($genre)) {
                if ($parson->description_count) {
                    Log::info('Searching for book description in his page ... ');
                    $parserObject->setGenre($genre[0]->nodes[$parson->description_count]->plaintext);
                    Log::info('Found book description in his page ... ');
                } else {
                    Log::info('Searching for book description in his page ... ');
                    $parserObject->setGenre($genre[0]->plaintext);
                    Log::info('Found book description in his page ... ');
                }
            } else {
                Log::info('Not found book description in his page ... ');
                $parserObject->setGenre(null);
            }
        }

        if ($parson->author) {
            Log::info('Searching for book image in his page ... ');
            $author = $html->find($parson->author);
            if (count($author)) {
                if ($parson->description_count) {
                    Log::info('Searching for book description in his page ... ');
                    $parserObject->setAuthor($author[0]->nodes[$parson->description_count]->plaintext);
                    Log::info('Found book description in his page ... ');
                } else {
                    Log::info('Searching for book description in his page ... ');
                    $parserObject->setAuthor($author[0]->plaintext);
                    Log::info('Found book description in his page ... ');
                }
            } else {
                Log::info('Not found book description in his page ... ');
                $parserObject->setAuthor(null);
            }
        }

        return $parserObject->getTitle() == '' ? null : $parserObject;
    }

    /**
     * @param $url
     * @param $data
     * @param Parson $parson
     *
     * @return ParseObject|array
     */
    public function parseSearchPage($url, $data, Parson $parson)
    {
        $rawurl = rawurlencode($data[0]);
        echo $url.$parson->searchUrl.'/'.$rawurl."\r\n";
        try {
            $html = file_get_contents($url.$parson->searchUrl.'/'.$rawurl);
        } catch (\ErrorException $e) {
            echo "Error while get content\r\n";
            return null;
        }
        $html = HtmlDomParser::str_get_html($html);
        if ($html == '') {
            Log::info('Failed url ... ');
            echo "Error while get html\r\n";
            return null;
        }
        echo "Got html content\r\n";
        Log::info('Found url ... ');
        $names = null;
        $urls = null;

        if ($parson->name_search) {
            if ($parson->name_search_count !== null) {
                echo "Searching for book name ... \r\n";
                Log::info('Searching for book name ... ');
                $names = $html->find($parson->name_search)[0]->nodes[$parson->name_search_count];
                Log::info('Found book name ... ');
                echo "Found book name ... \r\n";
            } else {
                Log::info('Searching for book name ... ');
                $names = $html->find($parson->name_search);
                Log::info('Found book name ... ');
            }
        }
        if ($parson->name_url) {
            if ($parson->name_url_count !== null) {
                Log::info('Searching for book url ... ');
                $urls = $html->find($parson->name_url)[0]->nodes[$parson->name_url_count];
                Log::info('Found book url ... ');
            } else {
                Log::info('Searching for book url ... ');
                $urls = $html->find($parson->name_url);
                Log::info('Found book url ... ');
            }
        }

        if ($names && $urls) {
            for ($i = 0; $i < count($names); $i++) {
                dd($names);
                if ($data[0] == $names[$i]) {
                    $parseObject = $this->parse($url, $parson);
                    if ($parseObject) {
                        dd($parseObject);
                        if (str_replace('-', '', $parseObject->getIsbn()) == str_replace('-', '', $data[2])) {
                            return $parseObject;
                            break;
                        }
                    }
                } else {
                    continue;
                }
            }
        }

        return null;
    }
}
