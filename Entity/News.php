<?php

class News
{
    private $file;
    private $title;
    private $description;
    private $content;
    private $date;

    /**
     * News constructor.
     * @param $file
     * @param $title
     * @param $description
     * @param $content
     * @param $date
     */
    public function __construct($file, $title, $description, $content, $date)
    {
        $this->file = $file;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

}