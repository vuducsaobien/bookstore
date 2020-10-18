<?php
// HEAD
require_once 'elements/head.php';
    $xhtml = '';
    if(!empty($this->Items)){
        foreach($this->Items as $key => $value){
            $cartID = $value['id'];
            $date   = date(TIMEDATE_FORMAT, strtotime($value['date']));

            $arrBookID		= json_decode($value['books']);
            $arrPrice		= json_decode($value['prices']);
            $arrName		= json_decode($value['names']);
            $arrQuantity	= json_decode($value['quantities']);
            $arrPicture		= json_decode($value['pictures']);
            
            $tableContent	= '';
            $totalPrice     = 0;
            foreach($arrBookID as $keyB => $valueB){
                $name       = $arrName[$keyB];
                $price      = HTML_Frontend::moneyFormat($arrPrice[$keyB]);
                $quantity   = $arrQuantity[$keyB];

                $totalPriceBook     = HTML_Frontend::moneyFormat($arrPrice[$keyB] * $arrQuantity[$keyB]);
                $totalPrice         += $arrPrice[$keyB] * $arrQuantity[$keyB];
                $totalPriceFormat   = HTML_Frontend::moneyFormat($totalPrice);


                $filePicture    = $arrPicture[$keyB];
                $folder         = TBL_BOOK;
                $picturePath 	= PATH_UPLOAD . $folder . DS . $filePicture;
                if(file_exists($picturePath)){
                    $picture = URL_UPLOAD . "$folder/$filePicture";
                }else{
                    $picture = URL_UPLOAD . $folder . DS . '98x150-default.jpg';
                }

                $linkBookDetail = URL::createLink('frontend', 'book', 'index', ['book_id' => $valueB, 'category_id' => $cateID], 
                "$cateNameURL/$bookNameURL-$cateID-$valueB.html");

                $tableContent .= '
                    <tr>
                        <td>
                            <a href="'.$linkBookDetail.'">
                                <img src="'.$picture.'" alt="'.$name.'" style="width: 80px">
                            </a>
                        </td>

                        <td style="min-width: 200px">'.$name.'</td>
                        <td style="min-width: 100px">'.$price.'</td>
                        <td>'.$quantity.'</td>
                        <td style="min-width: 150px">'.$totalPriceBook.'</td>
                    </tr>
                ';

        
            }

        $style = 'red';
        $content = 'Chờ Xác Nhận !';
        if($value['status'] == 'active')
        {
            $style = 'green';
            $content = 'Đang giao hàng !';
        }


            $xhtml .= '
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button style="text-transform: none;" class="btn btn-link collapsed" 
                            type="button" data-toggle="collapse" data-target="#'.$cartID.'">Mã đơn hàng: '.$cartID.'</button>
                            &nbsp;&nbsp;Thời gian: '.$date.'    
                            <span style="color: '.$style.';">&nbsp;&nbsp;Trạng Thái: '.$content.'</span>
                        </h5>
                    </div>

                    <div id="'.$cartID.'" class="collapse" data-parent="#accordionExample">
                        <div class="card-body table-responsive">
                            <table class="table btn-table">

                                    <thead>
                                        <td>Hình ảnh</td>
                                        <td>Tên sách</td>
                                        <td>Giá</td>
                                        <td>Số lượng</td>
                                        <td>Thành tiền</td>
                                    </thead>

                                    <tbody>'.$tableContent.'</tbody>

                                    <tfoot>
                                        <tr class="my-text-primary font-weight-bold">
                                            <td colspan="4" class="text-right">Tổng: </td>
                                            <td>'.$totalPriceFormat.'</td>
                                        </tr>
                                    </tfoot>

                            </table>
                        </div>
                    </div>

                </div>
            ';
        }
    }else{
        $xhtml = '
            <section class="p-0">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="error-section">
                                <h4>Bạn chưa mua sắm gì cả ??</h4>
                                <a href="index.php?module=frontend&controller=index&action=index" class="btn btn-solid">Quay lại trang chủ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        ';
    }
?>

<!-- TITLE -->
<?php require_once 'elements/title.php' ;?>

<section class="faq-section section-b-space">
    <div class="container">
        <div class="row">

			<!-- MENU -->
			<?php require_once 'elements/menu.php' ;?>

            <div class="col-lg-9">
                <div class="accordion theme-accordion" id="accordionExample">
                    <div class="accordion theme-accordion" id="accordionExample">
                        <?php echo $xhtml;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>