<?php

namespace App\Service;

use App\Entity\User;

class MailTemplateService {
    public function getValidateAccount(User $user): string {
        return '
            <!doctype html><html ⚡4email data-css-strict><head><meta charset="utf-8"><style amp4email-boilerplate>body{visibility:hidden}</style><script async src="https://cdn.ampproject.org/v0.js"></script><style amp-custom>.es-desk-hidden {	display:none;	float:left;	overflow:hidden;	width:0;	max-height:0;	line-height:0;}s {	text-decoration:line-through;}body {	width:100%;	font-family:"open sans", "helvetica neue", helvetica, arial, sans-serif;}table {	border-collapse:collapse;	border-spacing:0px;}table td, html, body, .es-wrapper {	padding:0;	Margin:0;}.es-content, .es-header, .es-footer {	table-layout:fixed;	width:100%;}p, hr {	Margin:0;}h1, h2, h3, h4, h5 {	Margin:0;	line-height:120%;	font-family:"open sans", "helvetica neue", helvetica, arial, sans-serif;}.es-left {	float:left;}.es-right {	float:right;}.es-p5 {	padding:5px;}.es-p5t {	padding-top:5px;}.es-p5b {	padding-bottom:5px;}.es-p5l {	padding-left:5px;}.es-p5r {	padding-right:5px;}.es-p10 {	padding:10px;}.es-p10t {	padding-top:10px;}.es-p10b {	padding-bottom:10px;}.es-p10l {	padding-left:10px;}.es-p10r {	padding-right:10px;}.es-p15 {	padding:15px;}.es-p15t {	padding-top:15px;}.es-p15b {	padding-bottom:15px;}.es-p15l {	padding-left:15px;}.es-p15r {	padding-right:15px;}.es-p20 {	padding:20px;}.es-p20t {	padding-top:20px;}.es-p20b {	padding-bottom:20px;}.es-p20l {	padding-left:20px;}.es-p20r {	padding-right:20px;}.es-p25 {	padding:25px;}.es-p25t {	padding-top:25px;}.es-p25b {	padding-bottom:25px;}.es-p25l {	padding-left:25px;}.es-p25r {	padding-right:25px;}.es-p30 {	padding:30px;}.es-p30t {	padding-top:30px;}.es-p30b {	padding-bottom:30px;}.es-p30l {	padding-left:30px;}.es-p30r {	padding-right:30px;}.es-p35 {	padding:35px;}.es-p35t {	padding-top:35px;}.es-p35b {	padding-bottom:35px;}.es-p35l {	padding-left:35px;}.es-p35r {	padding-right:35px;}.es-p40 {	padding:40px;}.es-p40t {	padding-top:40px;}.es-p40b {	padding-bottom:40px;}.es-p40l {	padding-left:40px;}.es-p40r {	padding-right:40px;}.es-menu td {	border:0;}a {	text-decoration:none;}p, ul li, ol li {	font-family:"open sans", "helvetica neue", helvetica, arial, sans-serif;	line-height:150%;}ul li, ol li {	Margin-bottom:15px;}.es-menu td a {	text-decoration:none;	display:block;	font-family:"open sans", "helvetica neue", helvetica, arial, sans-serif;}.es-menu amp-img, .es-button amp-img {	vertical-align:middle;}.es-wrapper {	width:100%;	height:100%;}.es-wrapper-color {	background-color:#EEEEEE;}.es-header {	background-color:transparent;}.es-header-body {	background-color:#044767;}.es-header-body p, .es-header-body ul li, .es-header-body ol li {	color:#FFFFFF;	font-size:14px;}.es-header-body a {	color:#FFFFFF;	font-size:14px;}.es-content-body {	background-color:#FFFFFF;}.es-content-body p, .es-content-body ul li, .es-content-body ol li {	color:#333333;	font-size:15px;}.es-content-body a {	color:#ED8E20;	font-size:15px;}.es-footer {	background-color:transparent;}.es-footer-body {	background-color:#FFFFFF;}.es-footer-body p, .es-footer-body ul li, .es-footer-body ol li {	color:#333333;	font-size:14px;}.es-footer-body a {	color:#333333;	font-size:14px;}.es-infoblock, .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li {	line-height:120%;	font-size:12px;	color:#CCCCCC;}.es-infoblock a {	font-size:12px;	color:#CCCCCC;}h1 {	font-size:36px;	font-style:normal;	font-weight:bold;	color:#333333;}h2 {	font-size:30px;	font-style:normal;	font-weight:bold;	color:#333333;}h3 {	font-size:20px;	font-style:normal;	font-weight:bold;	color:#333333;}.es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a {	font-size:36px;}.es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a {	font-size:30px;}.es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a {	font-size:20px;}a.es-button, button.es-button {	border-style:solid;	border-color:#ED8E20;	border-width:15px 30px 15px 30px;	display:inline-block;	background:#ED8E20;	border-radius:5px;	font-size:16px;	font-family:"open sans", "helvetica neue", helvetica, arial, sans-serif;	font-weight:bold;	font-style:normal;	line-height:120%;	color:#FFFFFF;	text-decoration:none;	width:auto;	text-align:center;}.es-button-border {	border-style:solid solid solid solid;	border-color:transparent transparent transparent transparent;	background:#ED8E20;	border-width:0px 0px 0px 0px;	display:inline-block;	border-radius:5px;	width:auto;}.es-p-default {	padding-top:20px;	padding-right:35px;	padding-bottom:0px;	padding-left:35px;}.es-p-all-default {	padding:0px;}@media only screen and (max-width:600px) {p, ul li, ol li, a { line-height:150% } h1, h2, h3, h1 a, h2 a, h3 a { line-height:120% } h1 { font-size:32px; text-align:center } h2 { font-size:26px; text-align:center } h3 { font-size:20px; text-align:center } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:32px } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:26px } .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:20px } .es-menu td a { font-size:16px } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px } .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a { font-size:16px } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:16px } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px } *[class="gmail-fix"] { display:none } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left } .es-m-txt-r amp-img { float:right } .es-m-txt-c amp-img { margin:0 auto } .es-m-txt-l amp-img { float:left } .es-button-border { display:inline-block } a.es-button, button.es-button { font-size:16px; display:inline-block; border-width:15px 30px 15px 30px } .es-btn-fw { border-width:10px 0px; text-align:center } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100% } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%; max-width:600px } .es-adapt-td { display:block; width:100% } .adapt-img { width:100%; height:auto } td.es-m-p0 { padding:0px } td.es-m-p0r { padding-right:0px } td.es-m-p0l { padding-left:0px } td.es-m-p0t { padding-top:0px } td.es-m-p0b { padding-bottom:0 } td.es-m-p20b { padding-bottom:20px } .es-mobile-hidden, .es-hidden { display:none } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto; overflow:visible; float:none; max-height:inherit; line-height:inherit } tr.es-desk-hidden { display:table-row } table.es-desk-hidden { display:table } td.es-desk-menu-hidden { display:table-cell } .es-menu td { width:1% } table.es-table-not-adapt, .esd-block-html table { width:auto } table.es-social { display:inline-block } table.es-social td { display:inline-block } }</style></head>
            <body><div class="es-wrapper-color"> <!--[if gte mso 9]><v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t"> <v:fill type="tile" color="#eeeeee"></v:fill> </v:background><![endif]--><table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0"><tr><td valign="top"><table class="es-content" cellspacing="0" cellpadding="0" align="center"><tr><td align="center" bgcolor="#efefef" style="background-color: #efefef"><table class="es-content-body" width="600" cellspacing="0" cellpadding="0" align="center" style="background-color: #efefef" bgcolor="#efefef"><tr><td class="es-p40t es-p35b es-p35r es-p35l" style="background-color: #ffffff" bgcolor="#ffffff" align="left"><table width="100%" cellspacing="0" cellpadding="0"><tr><td width="530" valign="top" align="center"><table width="100%" cellspacing="0" cellpadding="0" role="presentation"><tr><td align="center" class="es-p20b"><p style="color: #4ae3b5;font-family: \'merriweather sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size: 54px"><strong>SnowTricks</strong></p>
            </td></tr><tr><td class="es-p15b" align="center"><h2 style="color: #333333;font-family: \'open sans\', \'helvetica neue\', helvetica, arial, sans-serif">'. $user->getPseudo() .', votre compte a été créé !</h2></td></tr><tr><td class="es-m-txt-l es-p20t" align="left"><h3 style="font-size: 18px">Nous sommes ravi de vous acceuillir !</h3></td></tr><tr><td class="es-p15t es-p10b" align="left"><p style="font-size: 16px;color: #777777">Pour activer votre compte, vous devez choisir un mot de passe.<br>Cliquez sur le bouton ci-dessus.<br></p></td></tr><tr><td class="es-p25t es-p20b es-p10r es-p10l" align="center"><span class="es-button-border" style="background-color: #171332"><a href="'. $_ENV['APP_URL'] . '/validate-account/' . $user->getToken() . '" class="es-button es-button-1" target="_blank" style="font-weight: normal;border-width: 15px 30px;color: #ffffff;font-size: 18px;background-color: #171332;border-color: #171332">Activer mon compte</a></span></td></tr></table></td></tr></table></td></tr></table></td>
            </tr></table><table class="es-footer" cellspacing="0" cellpadding="0" align="center"><tr><td align="center" bgcolor="#efefef" style="background-color: #efefef"><table class="es-footer-body" width="600" cellspacing="0" cellpadding="0" align="center" bgcolor="#efefef" style="background-color: #efefef"><tr><td class="es-p35t es-p40b es-p35r es-p35l" align="left" bgcolor="#ffffff" style="background-color: #ffffff"><table width="100%" cellspacing="0" cellpadding="0"><tr><td width="530" valign="top" align="center"><table width="100%" cellspacing="0" cellpadding="0" role="presentation"><tr><td align="left" class="es-m-txt-c es-p5b"><p style="color: #777777;font-size: 12px">Vous recevez ce mail car un nouveau compte a été enregistré chez SnowTricks.</p></td></tr></table></td></tr></table></td></tr></table></td></tr></table></td></tr></table></div></body></html>
        ';
    }
}