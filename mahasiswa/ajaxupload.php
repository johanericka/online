<?php
//akses ke database
require_once('../system/dbconn.php');

//dapatkan info dari lab-isi.php
$nim = $_POST['nim'];
$button = $_POST['upload'];
$nodata = $_POST['nodata'];

if (isset($_POST) && !empty($_FILES['image']['name'])) {
	$valid_extensions = array('jpeg', 'jpg', 'pdf'); // valid extensions
	$filepath = '../uploads/';
	$img = $_FILES['image']['name'];
	$tmp = $_FILES['image']['tmp_name'];
	$size = $_FILES['image']['size'];

	//list($txt, $ext) = explode(".", $img); // alternative $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

	$ext = strtolower(substr($img, -3));
	if ($ext == 'peg') {
		$ext = 'jpg';
	}
	//$image_name = $txt.".".$ext;
	$image_name = $nim . $button . $nodata . "." . $ext;

	// Validate File extension
	if (in_array($ext, $valid_extensions)) {
		$filepath = $filepath . $image_name;
		compressImage($tmp, $filepath, 60);
		if (move_uploaded_file($tmp, $filepath)) {

			//resize image
			if ($ext != "pdf") {
				$width_size = 1024;
				list($width, $height) = getimagesize($filepath);
				$k = $width / $width_size;
				$newwidth = $width / $k;
				$newheight = $height / $k;
				$thumb = imagecreatetruecolor($newwidth, $newheight);
				$source = imagecreatefromjpeg($filepath);
				imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
				imagejpeg($thumb, $filepath);
				imagedestroy($thumb);
				imagedestroy($source);
			}

			echo '<br/>NIM=' . $nim;
			echo '<br/>NOData=' . $nodata;
			echo '<br/>Button=' . $button;

			$query = mysqli_query($dbsurat, "SELECT * FROM upload WHERE nim='$nim' AND nodata = '$nodata' AND keterangan='$button'");
			$cekhasil = mysqli_num_rows($query);
			echo "Hasil query = " . $cekhasil;

			if ($cekhasil > 0) {
				$query2 = "UPDATE upload SET namafile = '$filepath' WHERE nim = '$nim' AND nodata = '$nodata' AND keterangan = '$button'";
				if (mysqli_query($dbsurat, $query2)) {
					echo "data tersimpan";
					mysqli_close($dbsurat);
					if ($button == 'screeningcovid') {
						header("location:lab-isi-lamp1.php");
					} else {
						if ($button == 'karantinamandiri') {
							header("location:lab-isi-lamp4.php");
						} else {
							if ($button == 'kesanggupanprotokol') {
								header("location:lab-isi-lamp5.php");
							} else {
								if ($button == 'kesanggupanmengawasi') {
									header("location:lab-isi-lamp6.php");
								} else {
									if ($button == 'karantinamandirimlg') {
										header("location:lab-isi-lamp7.php");
									} else {
										if ($button == 'paktaintegritaspkl') {
											header("location:pkl-isilampiran.php");
										} else {
											if ($button == 'khs') {
												header("location:suket-isilampiran.php");
											}
										}
									}
								}
							}
						}
					}
				} else {
					echo "error " . $mysqli_error($dbsurat);
					header("location:index.php");
				}
			} else {
				$query2 = "INSERT INTO upload (nim, namafile, nodata, keterangan) VALUES ('$nim','$filepath','$nodata','$button')";
				if (mysqli_query($dbsurat, $query2)) {
					echo "data tersimpan";
					mysqli_close($dbsurat);
					if ($button == 'screeningcovid') {
						header("location:lab-isi-lamp1.php");
					} else {
						if ($button == 'karantinamandiri') {
							header("location:lab-isi-lamp4.php");
						} else {
							if ($button == 'kesanggupanprotokol') {
								header("location:lab-isi-lamp5.php");
							} else {
								if ($button == 'kesanggupanmengawasi') {
									header("location:lab-isi-lamp6.php");
								} else {
									if ($button == 'karantinamandirimlg') {
										header("location:lab-isi-lamp7.php");
									} else {
										if ($button == 'paktaintegritaspkl') {
											header("location:pkl-isilampiran.php");
										} else {
											if ($button == 'khs') {
												header("location:suket-isilampiran.php");
											}
										}
									}
								}
							}
						}
					}
				} else {
					header("location:index.php");
				}
			}
		} else {
			if ($button == 'screeningcovid') {
				echo "<script>alert('ERROR!! upload file gagal. Pastikan koneksi internet anda stabil / gunakan VPN');
					document.location='lab-isi-lamp1.php'</script>";
			} else {
				if ($button == 'karantinamandiri') {
					echo "<script>alert('ERROR!! upload file gagal. Pastikan koneksi internet anda stabil / gunakan VPN');
						document.location='lab-isi-lamp4.php'</script>";
				} else {
					if ($button == 'kesanggupanprotokol') {
						echo "<script>alert('ERROR!! upload file gagal. Pastikan koneksi internet anda stabil / gunakan VPN');
							document.location='lab-isi-lamp5.php'</script>";
					} else {
						if ($button == 'karantinamandirimlg') {
							echo "<script>alert('ERROR!! upload file gagal. Pastikan koneksi internet anda stabil / gunakan VPN');
								document.location='lab-isi-lamp7.php'</script>";
						} else {
							if ($button == 'paktaintegritaspkl') {
								echo "<script>alert('ERROR!! upload file gagal. Pastikan koneksi internet anda stabil / gunakan VPN');
									document.location='pkl-isilampiran.php'</script>";
							} else {
								if ($button == 'khs') {
									echo "<script>alert('ERROR!! upload file gagal. Pastikan koneksi internet anda stabil / gunakan VPN');
									document.location='suket-isilampiran.php'</script>";
								} else {
									if ($button == 'kesanggupanmengawasi') {
										echo "<script>alert('ERROR!! upload file gagal. Pastikan koneksi internet anda stabil / gunakan VPN');
										document.location='lab-isi-lamp6.php'</script>";
									}
								}
							}
						}
					}
				}
			}
		}
	} else {
		if ($button == 'screeningcovid') {
			echo "<script>alert('ERROR!! Hanya menerima format file JPG / PDF');
				document.location='lab-isi-lamp1.php'</script>";
		} else {
			if ($button == 'karantinamandiri') {
				echo "<script>alert('ERROR!! Hanya menerima format file JPG / PDF');
					document.location='lab-isi-lamp4.php'</script>";
			} else {
				if ($button == 'kesanggupanprotokol') {
					echo "<script>alert('ERROR!! Hanya menerima format file JPG / PDF');
						document.location='lab-isi-lamp5.php'</script>";
				} else {
					if ($button == 'kesanggupanmengawasi') {
						echo "<script>alert('ERROR!! Hanya menerima format file JPG / PDF');
							document.location='lab-isi-lamp6.php'</script>";
					} else {
						if ($button == 'karantinamandirimlg') {
							echo "<script>alert('ERROR!! Hanya menerima format file JPG / PDF');
							document.location='lab-isi-lamp7.php'</script>";
						} else {
							if ($button == 'paktaintegritaspkl') {
								echo "<script>alert('ERROR!! Hanya menerima format file JPG / PDF');
								document.location='pkl-isilampiran.php'</script>";
							} else {
								if ($button == 'khs') {
									echo "<script>alert('ERROR!! Hanya menerima format file JPG / PDF');
								document.location='suket-isilampiran.php'</script>";
								}
							}
						}
					}
				}
			}
		}
	}
} else {
	if ($button == 'screeningcovid') {
		echo "<script>alert('Tidak ada file yang di upload');
			document.location='lab-isi-lamp1.php'</script>";
	} else {
		if ($button == 'karantinamandiri') {
			echo "<script>alert('Tidak ada file yang di upload');
				document.location='lab-isi-lamp4.php'</script>";
		} else {
			if ($button == 'kesanggupanprotokol') {
				echo "<script>alert('Tidak ada file yang di upload');
					document.location='lab-isi-lamp5.php'</script>";
			} else {
				if ($button == 'kesanggupanmengawasi') {
					echo "<script>alert('Tidak ada file yang di upload');
						document.location='lab-isi-lamp6.php'</script>";
				} else {
					if ($button == 'karantinamandirimlg') {
						echo "<script>alert('Tidak ada file yang di upload');
						document.location='lab-isi-lamp7.php'</script>";
					} else {
						if ($button == 'paktaintegritaspkl') {
							echo "<script>alert('Tidak ada file yang di upload');
							document.location='pkl-isilampiran.php'</script>";
						} else {
							if ($button == 'khs') {
								echo "<script>alert('Tidak ada file yang di upload');
								document.location='suket-isilampiran.php'</script>";
							}
						}
					}
				}
			}
		}
	}
}

// Compress image
function compressImage($source, $destination, $quality)
{
	$info = getimagesize($source);
	if ($info['mime'] == 'image/jpeg')
		$image = imagecreatefromjpeg($source);
	elseif ($info['mime'] == 'image/gif')
		$image = imagecreatefromgif($source);
	elseif ($info['mime'] == 'image/PDF')
		$image = imagecreatefromPDF($source);
	imagejpeg($image, $destination, $quality);
}
