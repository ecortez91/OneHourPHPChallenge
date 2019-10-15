<?php
    class Product 
    {
        public $name;
        public $qty;
        public $price;
        public $datetime;
        public $id;
        private $file_location = "../results.json";

        public function __construct() {
            $this->id = $this->getId();
            $this->name = $_POST['txtName'];
            $this->qty = $_POST['txtQty'];
            $this->price = $_POST['txtPrice'];
            $this->datetime = $this->getDateTime();
        }

        private function getId() {
            //Increment last ID + 1
            $id = count(json_decode(file_get_contents($this->file_location))) + 1;
            return $id;
        }

        private function getDateTime() {
            $date = new DateTime();
            return $date->format('Y-m-d H:i:s');
        }

        public function processFile() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $text_on_file = file_get_contents($this->file_location);
                $fp = fopen($this->file_location, 'w');
                if (empty($text_on_file))
                    fwrite($fp, "[");
                if (substr($text_on_file, -1) == "]")
                    $text_on_file = substr_replace($text_on_file,"", -1);
                fwrite($fp, ($text_on_file));
                if (!empty($text_on_file)) 
                    fwrite($fp, ",");
                fwrite($fp, json_encode($this));
                fwrite($fp, "]");
                fclose($fp);
                $this->printFile();
            } elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
                parse_str(file_get_contents("php://input"),$post_vars);
                $all_data = json_decode(file_get_contents($this->file_location));
                foreach ($all_data as $prod) {
                    if ($prod->id == $post_vars['editId']) {
                        echo "success";
                    }
                }
            }
        }
        
        public function printFile() {
            $all_data = json_decode(file_get_contents($this->file_location));
                $total_value = 0;
                foreach ($all_data as $prod) {
                    $value = ($prod->price * $prod->qty);
                    $row = '';
                    $row .= '<tr class="table-active">';
                    $row .= "<td>$prod->id</td>";
                    $row .= "<td>$prod->name</td>";
                    $row .= "<td>" . number_format($prod->qty) . "</td>";
                    $row .= "<td> $" . number_format($prod->price) . "</td>";
                    $row .= "<td>$prod->datetime</td>";
                    $row .= "<td> $" . number_format($value) . "</td>";
                    $row .= '<td>
                            <button type="button" 
                                    class="btn btn-primary"
                                    data-toggle="modal"
                                    onclick="load_edit_info('. $prod->id .');"
                                    data-target="#exampleModalCenter">Edit
                            </button></td>';
                    $row .= "</tr>";
                    $total_value += $value;
                    echo $row;
                }
                echo "<tr><td colspan='5'></td><td><b>Total = $" . number_format($total_value) . "</b></td></tr>";
        }
    }

    $product = new Product();
    $product->processFile();
?>