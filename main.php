<?php

require_once 'Book.php';
require_once 'BookRepository.php';

function printBook(Book $book) {
    printf("\t- %s (with ISBN: %s) written by %s" . PHP_EOL,
        $book->getName(),
        $book->getInternationalStandardBookNumber(),
        $book->getAuthor()
    );
}

$bookRepository = new BookRepository('book_store.json');

$lordOfTheRings = new Book('Lord of the rings', 'J.R.R. Tolkien', '9780358653035');
$briefHistoryOfTime = new Book('A Brief History of time', 'Stephen Hawking', '9780553380163');
$twentyThousandLeaguesUnderTheSea = new Book('20,000 Leagues Under the Sea', 'Jules Verne', '9781949460575');

$bookRepository->saveBook($lordOfTheRings);
$bookRepository->saveBook($briefHistoryOfTime);
$bookRepository->saveBook($twentyThousandLeaguesUnderTheSea);

$books = $bookRepository->getAllBooks();
printf(PHP_EOL . "There are %d books saved to the store:" . PHP_EOL, count($books));
foreach ($books as $book) {
    printBook($book);
}

echo PHP_EOL . 'Updating book with ISBN "9780358653035" (Lord of the Rings), to have the correct author and title.' . PHP_EOL;
$bookRepository->updateBook('9780358653035', new Book('The Lord of the Rings', 'J.R.R. Tolkien', '9780358653035'));
$bookRepository->deleteBookByISBN('9780553380163');

$books = $bookRepository->getAllBooks();
printf(PHP_EOL . "There are now %d books saved to the store:" . PHP_EOL, count($books));
foreach ($books as $book) {
    printBook($book);
}

// Test getBookByISBN method
echo PHP_EOL . "Testing getBookByISBN('9780358653035'):" . PHP_EOL;
$bookByISBN = $bookRepository->getBookByISBN('9780358653035');
if ($bookByISBN !== null) {
    echo "Book found:" . PHP_EOL;
    printBook($bookByISBN);
} else {
    echo "Book with ISBN '9780358653035' not found." . PHP_EOL;
}

// Test getBookByTitle method
echo PHP_EOL . "Testing getBookByTitle('A Brief History of time'):" . PHP_EOL;
$bookByTitle = $bookRepository->getBookByTitle('A Brief History of time');
if ($bookByTitle !== null) {
    echo "Book found:" . PHP_EOL;
    printBook($bookByTitle);
} else {
    echo "Book with title 'A Brief History of time' not found." . PHP_EOL;
}
