<?php

class ControllerFeedLatestProductsRSS extends Controller {

	public function index() {
		if ($this->config->get('latest_products_rss_status')) {

			$this->load->model('catalog/product');
			$this->load->model('localisation/currency');
			$this->load->model('tool/image');
			$this->load->language('feed/latest_products_rss');

			$limit = $this->config->get('latest_products_rss_limit') ? $this->config->get('latest_products_rss_limit') : 100;
			$show_price = $this->config->get('latest_products_rss_show_price');
			$include_tax = $this->config->get('latest_products_rss_include_tax');
			$show_image = $this->config->get('latest_products_rss_show_image');


			if ($show_image) {
				$image_width = $this->config->get('latest_products_rss_image_width') ? $this->config->get('latest_products_rss_image_width') : 100;
				$image_height = $this->config->get('latest_products_rss_image_height') ? $this->config->get('latest_products_rss_image_height') : 100;
			}

			$products = $this->model_catalog_product->getLatestProducts($limit);

			if (isset($this->request->get['currency'])) {
				$currency = $this->request->get['currency'];
			} else {
				$currency = $this->currency->getCode();
			}

			$output = '<?xml version="1.0" encoding="UTF-8" ?>';
			$output .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">';
			$output .= '<channel>';
			$output .= '<atom:link href="' . HTTP_SERVER . 'index.php?route=feed/latest_products_rss" rel="self" type="application/rss+xml" />';
			$output .= '<title><![CDATA[' . $this->config->get('config_name') . ']]></title>';
			$output .= '<description><![CDATA[' . $this->config->get('config_meta_description') . ']]></description>';
			$output .= '<link><![CDATA[' . HTTP_SERVER . ']]></link>';
			
			foreach ($products as $product) {

				if ($product['description']) {

					$title = html_entity_decode($product['name']);

					$link = $this->url->link('product/product', 'product_id=' . $product['product_id']);

					$description = "";

					if ($show_price) {
						if ($include_tax) {
							if ((float) $product['special']) {
								$price = $this->currency->format($this->tax->calculate($product['special'], $product['tax_class_id']), $currency, FALSE, TRUE);
							} else {
								$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id']), $currency, FALSE, TRUE);
							}
						} else {
							if ((float) $product['special']) {
								$price = $this->currency->format($product['special'], $currency, FALSE, TRUE);
							} else {
								$price = $this->currency->format($product['price'], $currency, FALSE, TRUE);
							}
						}
						$description .= '<p><strong>' . $this->language->get('text_price') . ' ' . $price . '</strong></p>';
					}

					if ($show_image && $product['image'] != '') {
						$image_url = $this->model_tool_image->resize($product['image'], $image_width, $image_height);
						$description .= '<p><a href="' . $link . '"><img src="' . $image_url . '"></a></p>';
					}

					$description .= html_entity_decode($product['description']);

					$output .= '<item>';
					$output .= '<title><![CDATA[' . $title . ']]></title>';
					$output .= '<link>' . $link . '</link>';
					$output .= '<description><![CDATA[' . $description . ']]></description>';
					$output .= '<guid>' . $link . '</guid>';
					$output .= '<pubDate>' . date(DATE_RSS, strtotime($product['date_added'])) . '</pubDate>';

					$output .= '</item>';
				}
			}

			$output .= '</channel>';
			$output .= '</rss>';

			$this->response->addHeader('Content-Type: application/rss+xml');
			$this->response->setOutput($output);
		}
	}
	
	public function fbfeed() {
		if ($this->config->get('latest_products_rss_status')) {

			$this->load->model('catalog/product');
			$this->load->model('localisation/currency');
			$this->load->model('tool/image');
			$this->load->language('feed/latest_products_rss');

			$limit = $this->config->get('latest_products_rss_limit') ? $this->config->get('latest_products_rss_limit') : 100;
			$show_price = $this->config->get('latest_products_rss_show_price');
			$include_tax = $this->config->get('latest_products_rss_include_tax');
			$show_image = $this->config->get('latest_products_rss_show_image');


			if ($show_image) {
				$image_width = $this->config->get('latest_products_rss_image_width') ? $this->config->get('latest_products_rss_image_width') : 100;
				$image_height = $this->config->get('latest_products_rss_image_height') ? $this->config->get('latest_products_rss_image_height') : 100;
			}

			
			$products = $this->model_catalog_product->getProductsForFeed($limit);

			
			if (isset($this->request->get['currency'])) {
				$currency = $this->request->get['currency'];
			} else {
				$currency = $this->currency->getCode();
			}
			
			foreach ($products as $product) {

				if ($product['description']) {

					$title = html_entity_decode($product['name']);

					$link = $this->url->link('product/product', 'product_id=' . $product['product_id']);

					$description = "";

					// if ($show_price) {
						if ($include_tax) {
							if ((float) $product['special']) {
								$price = $this->currency->format($this->tax->calculate($product['special'], $product['tax_class_id']), $currency, FALSE, TRUE);
							} else {
								$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id']), $currency, FALSE, TRUE);
							}
						} else {
							if ((float) $product['special']) {
								$price = $this->currency->format($product['special'], $currency, FALSE, TRUE);
							} else {
								$price = $this->currency->format($product['price'], $currency, FALSE, TRUE);
							}
						}
						$description .= '<p><strong>' . $this->language->get('text_price') . ' ' . $price . '</strong></p>';
					// }

					// if ($show_image && $product['image'] != '') {
						$image_url = $this->model_tool_image->resize($product['image'], $image_width, $image_height);
						$description .= '<p><a href="' . $link . '"><img src="' . $image_url . '"></a></p>';
					// }

					$description .= html_entity_decode($product['description']);

					$output .= '<item>';
					$output .= '<title><![CDATA[' . $title . ']]></title>';
					$output .= '<link>' . $link . '</link>';
					$output .= '<description><![CDATA[' . $description . ']]></description>';
					$output .= '<guid>' . $link . '</guid>';
					$output .= '<pubDate>' . date(DATE_RSS, strtotime($product['date_added'])) . '</pubDate>';

					$output .= '</item>';
					$prc='Rp'.str_replace('.0000','',$product['price']);
					$cssv[]=array(
								'id'=>$product['product_id'],
								'availability'=>'in stock',
								'condition'=>'new',
								'description'=>'',
								'image_link '=>'http://www.dr-skincare.com/image/'.$product['image'],
								'link '=>$link,
								'title'=>$title,
								'price'=>$prc,
								'brand'=>'DRW Skincare',
								'gender'=>'female'
					);
				}
			}

			 // echo '<pre>';
			 // print_r($cssv);
			 // echo '</pre>';die;			
			
			$fileName = 'Billing-Summary.csv';
			 
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header('Content-Description: File Transfer');
			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename={$fileName}");
			header("Expires: 0");
			header("Pragma: public");

			$fh = @fopen( 'php://output', 'w' );

			$headerDisplayed = false;

			foreach ( $cssv as $data ) {
				// Add a header row if it hasn't been added yet
				if ( !$headerDisplayed ) {
					// Use the keys from $data as the titles
					fputcsv($fh, array_keys($data));
					$headerDisplayed = true;
				}
			 
				// Put the data into the stream
				fputcsv($fh, $data);
			}
			// Close the file
			fclose($fh);
			// Make sure nothing else is sent, our file is done
			exit;
			
			
			
		}
	}
}