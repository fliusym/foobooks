<?php

class Library
{
	//properties(variables)
	private $books;  //Array
	private $path;  //String

	//Methods
	public function setPath($path)
	{
		$this->path = $path;
	}

	public function getPath(){
		return $this->path;
	}

	public function getBooks(){
		//get the file
		$books = File::get(app_path().'/database/books.json');
		
		//convert to an array
		$this->books = json_decode($books,true);

		return $this->books;
	}

	/**
	* @param String $query
	* @return  Array $results
	*/
	public function search($query)
	{
		//if any books match our query, they will get stored in this array
		$results = array();	

		foreach ($this->books as $title => $book) {
			# code...
			if(stristr($title, $query)){
				$results[$title] = $book;
			}
			else
			{
				if(self::search_book_attributes($book,$query))
				{
					$results[$title] = $book;
				}
			}
		}
		return $results;
	}

	/**
	*
	*/
	private function search_book_attributes($attributes,$query)
	{
		foreach ($$attributes as $k => $value) {
			if(is_array($value))
			{
				return self::search_book_attributes($value,$query);
			}

			if(stristr($value,$query)){
				return true;
			}

		}
		return false;
	}

}