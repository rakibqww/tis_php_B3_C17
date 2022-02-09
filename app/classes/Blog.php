<?php


namespace App\classes;


class Blog{
    protected $title;
    protected $authorName;
    protected $description;
    protected $image;
    protected $blogImage;
    protected $directory;
    protected $fileName;
    protected $file;
    protected $data;
    protected $array;
    protected $array1;
    protected $array2;


    public function __construct($post = null){
//        echo '<pre>';
//        print_r($post);
//        print_r($_FILES);
//        exit();
        if ($post){
            $this->title = $post['title'];
            $this->authorName = $post['author_name'];
            $this->description = $post['description'];
        }
    }
    public function index(){
        $this->image = $this->imageUpload();
//        echo $this->image;
//        exit();
        $this->fileName = 'db.txt';
        $this->file =  fopen('db.txt', 'a');
        $this->data = "$this->title,$this->authorName,$this->description,$this->image$";
        fwrite($this->file, $this->data);
        fclose($this->file);
        return 'Data Save Successfully.';
    }
    public function imageUpload(){
        $this->blogImage = $_FILES['blog_image']['name'];
        $this->directory = 'assets/img/upload/'.$this->blogImage;
        move_uploaded_file($_FILES['blog_image']['tmp_name'], $this->directory);
        return $this->directory;
    }
    public function getAllBlogs(){
        $this->fileName = 'db.txt';
         $this->data = file_get_contents($this->fileName);
         $this->array = explode('$',$this->data);
//         echo '<pre>';
//        // echo $this->array;
//        print_r($this->array);
//         exit();
        foreach ($this->array as $key => $value){
//            echo $value;
//            echo '<br><br>';
            $this->array2 = explode(',', $value);
                if ($this->array2[0]){
                    $this->array1[$key]['title'] = $this->array2[0];
                    $this->array1[$key]['author'] = $this->array2[1];
                    $this->array1[$key]['description'] = $this->array2[2];
                    $this->array1[$key]['image'] = $this->array2[3];
                }
        }
//        echo '<pre>';
//        print_r($this->array1);
        return $this->array1;
    }

}