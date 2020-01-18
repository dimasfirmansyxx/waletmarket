<?php 

class Func_model extends CI_Model {
	public function check_availability($table,$key,$value)
	{
		$this->db->where($key,$value);
		$row = $this->db->count_all_results($table);
		if ( $row > 0 ) {
			return 2;
		} else {
			return 3;
		}
	}

	public function check_availability_edit($table,$key,$value,$verif,$verifvalue)
	{
		$this->db->where($key,$value);
		$count = $this->db->count_all_results($table);
		if ( $count > 0 ) {
			$get = $this->get_data($table,$key,$value);
			if ( $get[$verif] == $verifvalue ) {
				return 3;
			} else {
				return 2;
			}
		} else {
			return 3;
		}
	}

	public function check_availability_multicondition($table,$condition)
	{
		$query = $this->db->get_where($table,$condition);
		if ( $query->num_rows() > 0 ) {
			return 2;
		} else {
			return 3;
		}
	}

	public function num_rows($table,$key,$value)
	{
		$this->db->where($key,$value);
		return $this->db->get($table)->num_rows();
	}

	public function upload_files($key,$directory,$allow_extension)
	{
		if ( $_FILES[$key]['error'] == 4 ) {
			return "";
		} else {
			$name = $_FILES[$key]['name'];
			$tmp = $_FILES[$key]['tmp_name'];
			$explodename = explode(".", $name);
			$extension = strtolower(end($explodename));

			if ( in_array($extension, $allow_extension) ) {
				$newName = uniqid() . "." . $extension;
				$dir = "./assets/" . $directory;
				move_uploaded_file($tmp, $dir . $newName);

				return $newName;				
			} else {
				return 4;
			}
		}

	}

	public function multipleupload_files($key,$directory,$allow_extension)
	{
		if ( $_FILES[$key]['error'] == 4 ) {
			return "";
		} else {
			$total = count($_FILES[$key]['name']);
			$returnName = array();

			for ($i=0; $i < $total; $i++) { 
				$name = $_FILES[$key]['name'][$i];
				$tmp = $_FILES[$key]['tmp_name'][$i];
				$explodename = explode(".", $name);
				$extension = strtolower(end($explodename));

				if ( in_array($extension, $allow_extension) ) {
					$newName = uniqid() . "." . $extension;
					$dir = "./assets/" . $directory;
					move_uploaded_file($tmp, $dir . $newName);

					array_push($returnName, $newName);
				} else {
					return 4;
				}
			}

			return $returnName;
		}

	}

	public function get_data($table,$key,$value)
	{
		if ( $this->check_availability($table,$key,$value) == 2 ) {
			$this->db->where($key,$value);
			return $this->db->get($table)->result_array()[0];
		} else {
			return 3;
		}
	}

	public function get_query($table,$key,$value)
	{
		if ( $this->check_availability($table,$key,$value) == 2 ) {
			$this->db->where($key,$value);
			return $this->db->get($table)->result_array();
		} else {
			return 3;
		}
	}

	public function site_info($show)
	{
		$this->db->where("info",$show);
		return $this->db->get("tblsiteinfo")->result_array()[0]['value'];
	}

	public function get_all_jenis()
	{
		return $this->db->get("tbljenis")->result_array();
	}

	public function get_jenis($id_jenis)
	{
		return $this->get_data("tbljenis","id_jenis",$id_jenis);
	}

	public function get_all_infoharga()
	{
		$this->db->order_by("id_info","desc");
		return $this->db->get("tblinfoharga")->result_array();
	}

	public function get_info_harga($id_info)
	{
		$this->db->where("id_info",$id_info);
		return $this->db->get("tblinfohargadetail")->result_array();
	}

	public function get_last_infoharga()
	{
		$this->db->order_by("id_info","desc");
		$get = $this->db->get("tblinfoharga")->result_array()[0];
		$result = [
			"tanggal" => $get['tanggal']
		];

		$detail = $this->get_info_harga($get['id_info']);
		foreach ($detail as $row) {
			$getjenis = $this->get_jenis($row['id_jenis']);
			$result[$getjenis['jenis']] = $row['harga'];
		}

		return $result;
	}

	public function get_posting($id_posting)
	{
		return $this->get_data("tblposting","id_posting",$id_posting);
	}

	public function get_last_id($table,$key)
	{
		$this->db->order_by($key,"desc");
		$get = $this->db->get($table)->result_array();
		return $get[0][$key];
	}

	public function send_mail($destination,$nama,$subject,$message,$attach = null)
	{
		$config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'srv87.niagahoster.com',
            'smtp_user' => 'no-reply@waletmarket.com',  // Email gmail
            'smtp_pass'   => 'walet123',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];
        $this->load->library('email', $config);

        $this->email->from('no-reply@waletmarket.com', 'Walet Market (no-reply)');

        $this->email->to($destination);

        if ( !($attach == null) ) {
        	foreach ($attach as $item) {
        		$this->email->attach($item);
        	}
        }

        $this->email->subject($subject);

        $this->email->message("
        	<!doctype html>
				<html>
				  <head>
				    <meta name='viewport' content='width=device-width' />
				    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
				    <title>Walet Market</title>
				    <style>
				      /* -------------------------------------
				          GLOBAL RESETS
				      ------------------------------------- */
				      
				      /*All the styling goes here*/
				      
				      img {
				        border: none;
				        -ms-interpolation-mode: bicubic;
				        max-width: 100%; 
				      }

				      body {
				        background-color: #000;
				        font-family: sans-serif;
				        -webkit-font-smoothing: antialiased;
				        font-size: 14px;
				        line-height: 1.4;
				        margin: 0;
				        padding: 0;
				        -ms-text-size-adjust: 100%;
				        -webkit-text-size-adjust: 100%; 
				      }

				      table {
				        border-collapse: separate;
				        mso-table-lspace: 0pt;
				        mso-table-rspace: 0pt;
				        width: 100%; }
				        table td {
				          font-family: sans-serif;
				          font-size: 14px;
				          vertical-align: top; 
				      }

				      /* -------------------------------------
				          BODY & CONTAINER
				      ------------------------------------- */

				      .body {
				        background-color: #f6f6f6;
				        width: 100%; 
				      }

				      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
				      .container {
				        display: block;
				        margin: 0 auto !important;
				        /* makes it centered */
				        max-width: 580px;
				        padding: 10px;
				        width: 580px; 
				      }

				      /* This should also be a block element, so that it will fill 100% of the .container */
				      .content {
				        box-sizing: border-box;
				        display: block;
				        margin: 0 auto;
				        max-width: 580px;
				        padding: 10px; 
				      }

				      /* -------------------------------------
				          HEADER, FOOTER, MAIN
				      ------------------------------------- */
				      .main {
				        background: #ffffff;
				        border-radius: 3px;
				        width: 100%; 
				      }

				      .wrapper {
				        box-sizing: border-box;
				        padding: 20px; 
				      }

				      .content-block {
				        padding-bottom: 10px;
				        padding-top: 10px;
				      }

				      .footer {
				        clear: both;
				        margin-top: 10px;
				        text-align: center;
				        width: 100%; 
				      }
				        .footer td,
				        .footer p,
				        .footer span,
				        .footer a {
				          color: #999999;
				          font-size: 12px;
				          text-align: center; 
				      }

				      /* -------------------------------------
				          TYPOGRAPHY
				      ------------------------------------- */
				      h1,
				      h2,
				      h3,
				      h4 {
				        color: #000000;
				        font-family: sans-serif;
				        font-weight: 400;
				        line-height: 1.4;
				        margin: 0;
				        margin-bottom: 30px; 
				      }

				      h1 {
				        font-size: 35px;
				        font-weight: 300;
				        text-align: center;
				        text-transform: capitalize; 
				      }

				      p,
				      ul,
				      ol {
				        font-family: sans-serif;
				        font-size: 14px;
				        font-weight: normal;
				        margin: 0;
				        margin-bottom: 15px; 
				      }
				        p li,
				        ul li,
				        ol li {
				          list-style-position: inside;
				          margin-left: 5px; 
				      }

				      a {
				        color: #3498db;
				        text-decoration: underline; 
				      }

				      /* -------------------------------------
				          BUTTONS
				      ------------------------------------- */
				      .btn {
				        box-sizing: border-box;
				        width: 100%; }
				        .btn > tbody > tr > td {
				          padding-bottom: 15px; }
				        .btn table {
				          width: auto; 
				      }
				        .btn table td {
				          background-color: #ffffff;
				          border-radius: 5px;
				          text-align: center; 
				      }
				        .btn a {
				          background-color: #ffffff;
				          border: solid 1px #3498db;
				          border-radius: 5px;
				          box-sizing: border-box;
				          color: #3498db;
				          cursor: pointer;
				          display: inline-block;
				          font-size: 14px;
				          font-weight: bold;
				          margin: 0;
				          padding: 12px 25px;
				          text-decoration: none;
				          text-transform: capitalize; 
				      }

				      .btn-primary table td {
				        background-color: #3498db; 
				      }

				      .btn-primary a {
				        background-color: #3498db;
				        border-color: #3498db;
				        color: #ffffff; 
				      }

				      /* -------------------------------------
				          OTHER STYLES THAT MIGHT BE USEFUL
				      ------------------------------------- */
				      .last {
				        margin-bottom: 0; 
				      }

				      .first {
				        margin-top: 0; 
				      }

				      .align-center {
				        text-align: center; 
				      }

				      .align-right {
				        text-align: right; 
				      }

				      .align-left {
				        text-align: left; 
				      }

				      .clear {
				        clear: both; 
				      }

				      .mt0 {
				        margin-top: 0; 
				      }

				      .mb0 {
				        margin-bottom: 0; 
				      }

				      .preheader {
				        color: transparent;
				        display: none;
				        height: 0;
				        max-height: 0;
				        max-width: 0;
				        opacity: 0;
				        overflow: hidden;
				        mso-hide: all;
				        visibility: hidden;
				        width: 0; 
				      }

				      .powered-by a {
				        text-decoration: none; 
				      }

				      hr {
				        border: 0;
				        border-bottom: 1px solid #f6f6f6;
				        margin: 20px 0; 
				      }

				      /* -------------------------------------
				          RESPONSIVE AND MOBILE FRIENDLY STYLES
				      ------------------------------------- */
				      @media only screen and (max-width: 620px) {
				        table[class=body] h1 {
				          font-size: 28px !important;
				          margin-bottom: 10px !important; 
				        }
				        table[class=body] p,
				        table[class=body] ul,
				        table[class=body] ol,
				        table[class=body] td,
				        table[class=body] span,
				        table[class=body] a {
				          font-size: 16px !important; 
				        }
				        table[class=body] .wrapper,
				        table[class=body] .article {
				          padding: 10px !important; 
				        }
				        table[class=body] .content {
				          padding: 0 !important; 
				        }
				        table[class=body] .container {
				          padding: 0 !important;
				          width: 100% !important; 
				        }
				        table[class=body] .main {
				          border-left-width: 0 !important;
				          border-radius: 0 !important;
				          border-right-width: 0 !important; 
				        }
				        table[class=body] .btn table {
				          width: 100% !important; 
				        }
				        table[class=body] .btn a {
				          width: 100% !important; 
				        }
				        table[class=body] .img-responsive {
				          height: auto !important;
				          max-width: 100% !important;
				          width: auto !important; 
				        }
				      }

				      /* -------------------------------------
				          PRESERVE THESE STYLES IN THE HEAD
				      ------------------------------------- */
				      @media all {
				        .ExternalClass {
				          width: 100%; 
				        }
				        .ExternalClass,
				        .ExternalClass p,
				        .ExternalClass span,
				        .ExternalClass font,
				        .ExternalClass td,
				        .ExternalClass div {
				          line-height: 100%; 
				        }
				        .apple-link a {
				          color: inherit !important;
				          font-family: inherit !important;
				          font-size: inherit !important;
				          font-weight: inherit !important;
				          line-height: inherit !important;
				          text-decoration: none !important; 
				        }
				        #MessageViewBody a {
				          color: inherit;
				          text-decoration: none;
				          font-size: inherit;
				          font-family: inherit;
				          font-weight: inherit;
				          line-height: inherit;
				        }
				        .btn-primary table td:hover {
				          background-color: #34495e !important; 
				        }
				        .btn-primary a:hover {
				          background-color: #34495e !important;
				          border-color: #34495e !important; 
				        } 
				      }

				    </style>
				  </head>
				  <body class='>
				    <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body'>
				      <tr>
				        <td>&nbsp;</td>
				        <td class='container'>
				          <div class='content'>
				            <table role='presentation' class='main'>
				              <tr>
				                <td class='wrapper'>
				                  <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
				                  	<tr>
				                  		<td style='text-align: center;'>
				                  			<h2>WALET MARKET</h2>
				                  		</td>
				                  	</tr>
				                    <tr>
				                      <td>
				                        <p>Hai, $nama !</p>
				                        <p>
				                        	$message
				                        </p>

				                        <p>Salam.</p>
				                      </td>
				                    </tr>
				                  </table>
				                </td>
				              </tr>

				            <!-- END MAIN CONTENT AREA -->
				            </table>
				            <!-- END CENTERED WHITE CONTAINER -->

				            <!-- START FOOTER -->
				            <div class='footer'>
				              <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
				                <tr>
				                  <td class='content-block'>
				                    <span class='apple-link'>Walet Market</span>
				                    <br>
				                    Hubungi Kami : <a href='mailto:contact@waletmarket.com'>contact@waletmarket.com</a>
				                  </td>
				                </tr>
				              </table>
				            </div>
				            <!-- END FOOTER -->

				          </div>
				        </td>
				        <td>&nbsp;</td>
				      </tr>
				    </table>
				  </body>
				</html>
        ");

        if ($this->email->send()) {
            return 0;
        } else {
            return $this->email->print_debugger();
        }
	}
}