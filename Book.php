<?php

class Book implements JsonSerializable {
    private string $name;
    private string $authorName;
    private string $isbn;

    public function __construct(string $theName = '', string $theAuthor = '', string $theIsbn = '') {
        $this->setName($theName);
        $this->setAuthor($theAuthor);
        $this->setInternationalStandardBookNumber($theIsbn);
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getAuthor(): string {
        return $this->authorName;
    }

    public function setAuthor(string $authorName): void {
        $this->authorName = $authorName;
    }

    public function getInternationalStandardBookNumber(): string {
        return $this->isbn;
    }

    public function setInternationalStandardBookNumber(string $isbn): void {
        $this->isbn = $isbn;
    }

    public function fill(array $bookData): Book {
        foreach ($bookData as $key => $value) {
            $this->{$key} = $value; // dynamically add properties to the Book object
        }
        return $this;
    }

    public function jsonSerialize() {
        return [
            'name' => $this->name,
            'authorName' => $this->authorName,
            'isbn' => $this->isbn
        ];
    }
}
