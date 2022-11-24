<?PHP if(!empty($connection)){
echo'
<title>'.$metasocial_title.$metasocial_name.'</title>
<!-- Favicons -->
<link rel="shortcut icon" href="'.$favicon.'">
<link rel="apple-touch-icon" href="'.$favicon.'">
<link rel="apple-touch-icon" sizes="72x72" href="'.$favicon.'">
<link rel="apple-touch-icon" sizes="114x114" href="'.$favicon.'">
<meta name="robots" content="index, follow" />
<meta name="description" content="'.$metasocial_desc.'">
<meta name="keywords" content="'.$metasocial_key.'">
<meta name="author" content="'.$website_name.'">
<meta http-equiv="Copyright" content="'.$website_name.'">
<meta name="copyright" content="'.$website_name.'">


<meta name="subject" content="'.$metasocial_key.'">
<meta name="topic" content="'.$metasocial_key.'">

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="'.$website_url.'/feed/" />
<meta property="place:location:latitude" content="-5.406042," /> 
<meta property="place:location:longitude" content="105.300922" /> 
<meta property="business:contact_data:street_address" content="'.$website_addres.'" />
<meta property="business:contact_data:locality" content="Bandar Lampung" /> 
<meta property="business:contact_data:postal_code" content="35141" /> 
<meta property="business:contact_data:country_name" content="Indonesia" /> 
<meta property="business:contact_data:email" content="'.$website_email.'" /> 
<meta property="business:contact_data:phone_number" content="+62 '.$website_phone.'" /> 

<meta property="og:type" content="article" />
<meta property="profile:first_name" content="'.$website_name.'" />
<meta property="profile:last_name" content="'.$website_name.'" /> 
<meta property="profile:username" content="'.$website_name.'" />
<!-- facebook -->
<meta property="og:title" content="'.$metasocial_title.$metasocial_name.'" />
<meta property="og:type" content="blog">
<meta property="og:description" content="'.$metasocial_desc.'" />
<meta property="og:image" content="'.$metasocial_img.'" />
<meta property="og:url" content="'.$metasocial_url.'" />
<meta property="og:site_name" content="'.$website_name.'" />
<!-- twitter -->
<meta name="twitter:card" content="summary" />  <!-- Card type jangan di ganti -->
<meta name="twitter:site" content="'.$website_name.'" />
<meta name="twitter:title" content="'.$metasocial_title.$metasocial_name.'" />
<meta name="twitter:description" content="'.$metasocial_desc.'" />
<meta name="twitter:creator" content="'.$website_name.'" /> <!-- Silahkan disesuaikan -->
<meta name="twitter:image:src" content="'.$metasocial_img.'" />
<meta name="twitter:domain" content="'.$metasocial_url.'" />
<!-- google -->
<meta itemprop="name" content="'.$metasocial_title.$metasocial_name.'" />
<meta itemprop="description" content="'.$metasocial_desc.'" />
<meta itemprop="image" content="'.$metasocial_img.'" />
<!-- Verifikasi -->
<link href="'.$social_google.'/posts" rel="author" />
<link href="'.$social_google.'/" rel="publisher"/>
<meta name="google-site-verification" content="'.$id_googleweb.'" />
<meta name="msvalidate.01" content="'.$id_bing.'" />
<meta name="alexaVerifyID" content="'.$id_alexa.'" />';
}?>