<?php

class Comments
{
    private $comments;
    private $date;

    /**
     * Comments constructor.
     * @param $comments
     * @param $date
     */
    public function __construct($comments, $date)
    {
        $this->comments = $comments;
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

}