<?php

    class Product {
        private $id;
        private $category_id;
        private $name;
        private $description;
        private $price;
        private $stock;
        private $image;
        private $active;

        public function getId() {
            return $this->id; 
        }

        public function setId($id) { 
            $this->id = $id; 
        }

        public function getCategoryId() { 
            return $this->category_id;
        }
        
        public function setCategoryId($category_id) { 
            $this->category_id = $category_id; 
        }

        public function getName() { 
            return $this->name; 
        }

        public function setName($name) { 
            $this->name = $name; 
        }

        public function getDescription() { 
            return $this->description; 
        }

        public function setDescription($description) { 
            $this->description = $description; 
        }

        public function getPrice() { 
            return $this->price; 
        }

        public function setPrice($price) { 
            $this->price = $price;
        }

        public function getStock() { 
            return $this->stock; 
        }

        public function setStock($stock) { 
            $this->stock = $stock; 
        }

        public function getImage() { 
            return $this->image; 
        }

        public function setImage($image) { 
            $this->image = $image; 
        }

        public function getActive() { 
            return $this->active; 
        }

        public function setActive($active) { 
            $this->active = $active; 
        }
    }
?>