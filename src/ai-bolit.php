<?php
///////////////////////////////////////////////////////////////////////////
// Автор: Григорий Земсков
// Email: audit@revisium.com, http://revisium.com/ai/, skype: greg_zemskov

// Запрещено использовать скрипт в коммерческих целях без согласования с автором скрипта.
// Запрещено использовать код скрипта  без согласования с автором скрипта.

// Получение свидетельства о государственной регистрации ПЭВМ в РосПатенте - в процессе
///////////////////////////////////////////////////////////////////////////

define('PASS', '121430'); // пароль для запуска

$defaults = array(
	'path' => dirname(__FILE__),
	'scan_all_files' => 0, // полное сканирование файлов (не только .js, .php, .html, .htaccess)
	'scan_delay' => 1, // задержка в миллисекундах при сканировании файлов для снижения нагрузки на файловую систему
	'max_size_to_scan' => '5M',
	'site_url' => '', // адрес вашего сайта
	'no_rw_dir' => 0
);

define('DEBUG_MODE', 0);

// завернутые сигнатуры, чтобы не ругались антивирусы на PC и на хостинге
$g_DBShe = unserialize(base64_decode("YTozMjU6e2k6MDtzOjI3OiIkZGVmYXVsdF9hY3Rpb24gPSAnRmlsZXNNYW4iO2k6MTtzOjk0OiIkaW5mbyAuPSAoKCRwZXJtcyAmIDB4MDA0MCkgPygoJHBlcm1zICYgMHgwODAwKSA/ICdzJyA6ICd4JyApIDooKCRwZXJtcyAmIDB4MDgwMCkgPyAnUycgOiAnLScpIjtpOjI7czo4NDoiPHRleHRhcmVhIG5hbWU9XCJwaHBldlwiIHJvd3M9XCI1XCIgY29scz1cIjE1MFwiPiIuQCRfUE9TVFsncGhwZXYnXS4iPC90ZXh0YXJlYT48YnI+IjtpOjM7czoxMDE6IjdUTUdBSFk1S2FNOW8zN1cvR1EvZnJGSmV0ZnFsUkdPNkZTUlRNbTdJTFNtMzVvNXo0K3YwbWNmNEthSGdLUzVZMTdlcXF2RDJtbU44Tnp0ZXlwbE5kNldPd3JRVks0NDVKL3kwIjtpOjQ7czoxNjoiYzk5ZnRwYnJ1dGVjaGVjayI7aTo1O3M6ODoiYzk5c2hlbGwiO2k6NjtzOjg6InI1N3NoZWxsIjtpOjc7czoxNDoidGVtcF9yNTdfdGFibGUiO2k6ODtzOjc2OiJSMGxHT0RsaEpnQVdBSUFBQUFBQUFQLy8veUg1QkFVVUFBRUFMQUFBQUFBbUFCWUFBQUl2akkrcHkrMFBGNGkwZ1Z2enVWeFhEbm9RIjtpOjk7czo3OiJjYXN1czE1IjtpOjEwO3M6MTM6IldTQ1JJUFQuU0hFTEwiO2k6MTE7czo0NzoiRXhlY3V0ZWQgY29tbWFuZDogPGI+PGZvbnQgY29sb3I9I2RjZGNkYz5bJGNtZF0iO2k6MTI7czoxMToiY3RzaGVsbC5waHAiO2k6MTM7czoxMTE6IkJEQVFrSkNRd0xEQmdORFJneUlSd2hNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpJeU1qSXlNakl5TWpML3dBQVJDQUFRQUJBREFTSUFBaEVCQSI7aToxNDtzOjMwOiJbQXY0YmZDWUNTLHhLV2skK1RrVVMseG5HZEF4W08iO2k6MTU7czoxNToiRFhfSGVhZGVyX2RyYXduIjtpOjE2O3M6MTA2OiI5dFpTQjBieUJ5TlRjZ2MyaGxiR3dnSmlZZ0wySnBiaTlpWVhOb0lDMXBJaWs3RFFvZ0lDQmxiSE5sRFFvZ0lDQm1jSEpwYm5SbUtITjBaR1Z5Y2l3aVUyOXljbmtpS1RzTkNpQWdJR05zIjtpOjE3O3M6ODY6ImNybGYuJ3VubGluaygkbmFtZSk7Jy4kY3JsZi4ncmVuYW1lKCJ+Ii4kbmFtZSwgJG5hbWUpOycuJGNybGYuJ3VubGluaygiZ3JwX3JlcGFpci5waHAiIjtpOjE4O3M6MTA1OiIvMHRWU0cvU3V2MFVyL2hhVVlBZG4zak1Rd2Jib2NHZmZBZUMyOUJOOXRtQmlKZFYxbGsrallEVTkyQzk0amR0RGlmK3hPWWpHNkNMaHgzMVVvOXg5L2VBV2dzQks2MGtLMm1Md3F6cWQiO2k6MTk7czoxMTU6Im1wdHkoJF9QT1NUWyd1ciddKSkgJG1vZGUgfD0gMDQwMDsgaWYgKCFlbXB0eSgkX1BPU1RbJ3V3J10pKSAkbW9kZSB8PSAwMjAwOyBpZiAoIWVtcHR5KCRfUE9TVFsndXgnXSkpICRtb2RlIHw9IDAxMDAiO2k6MjA7czo0NDoiV1QrUHt+RVcwRXJQT3RuVUAjQCZebF5zUDFsZG55QCNAJm5zaytyMCxHVCsiO2k6MjE7czozNzoia2xhc3ZheXYuYXNwP3llbmlkb3N5YT08JT1ha3RpZmtsYXMlPiI7aToyMjtzOjEyMjoibnQpKGRpc2tfdG90YWxfc3BhY2UoZ2V0Y3dkKCkpLygxMDI0KjEwMjQpKSAuICJNYiAiIC4gIkZyZWUgc3BhY2UgIiAuIChpbnQpKGRpc2tfZnJlZV9zcGFjZShnZXRjd2QoKSkvKDEwMjQqMTAyNCkpIC4gIk1iIDwiO2k6MjM7czozMToicygpLmcoKS5zKCkucygpLmcoKS5zKCkucygpLmcoKSI7aToyNDtzOjg4OiJDUmJza0VJUyt5YktBd2M2L09CMWpVOFkwWUlNVlVoeGhhT0lzSEFDQnlEMHdNQU5PSHFZNVk0OGd1aUJuQ2hrd1BZTlRreGRCUlZSWkxIRmtvalk5NklJIjtpOjI1O3M6NTU6Ikl5RXZkWE55TDJKcGJpOXdaWEpzRFFva1UwaEZURXc5SWk5aWFXNHZZbUZ6YUNBdGFTSTdEUXAiO2k6MjY7czoxMjc6IkNCMmFUWnBJREV3TWpRdERRb2pMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUzB0TFMwdExTMHRMUTBLSTNKbGNYVnAiO2k6Mjc7czo3OiJOVERhZGR5IjtpOjI4O3M6NzY6ImEgaHJlZj0iPD9lY2hvICIkZmlzdGlrLnBocD9kaXppbj0kZGl6aW4vLi4vIj8+IiBzdHlsZT0idGV4dC1kZWNvcmF0aW9uOiBub24iO2k6Mjk7czoxMTU6IlRSVUZFUkZJc01TazdEUXBpYVc1a0tGTXNjMjlqYTJGa1pISmZhVzRvSkV4SlUxUkZUbDlRVDFKVUxFbE9RVVJFVWw5QlRsa3BLU0I4ZkNCa2FXVWdJa05oYm5RZ2IzQmxiaUJ3YjNKMFhHNGlPdzBLYkciO2k6MzA7czozODoiUm9vdFNoZWxsIScpO3NlbGYubG9jYXRpb24uaHJlZj0naHR0cDoiO2k6MzE7czoxMTM6Im05MWRDd2dKR1Z2ZFhRcE93MEtjMlZzWldOMEtDUnliM1YwSUQwZ0pISnBiaXdnZFc1a1pXWXNJQ1JsYjNWMElEMGdKSEpwYml3Z01USXdLVHNOQ21sbUlDZ2hKSEp2ZFhRZ0lDWW1JQ0FoSkdWdmRYIjtpOjMyO3M6OTA6IjwlPVJlcXVlc3QuU2VydmVyVmFyaWFibGVzKCJzY3JpcHRfbmFtZSIpJT4/Rm9sZGVyUGF0aD08JT1TZXJ2ZXIuVVJMUGF0aEVuY29kZShGb2xkZXIuRHJpdiI7aTozMztzOjczOiJSMGxHT0RsaEZBQVVBS0lBQUFBQUFQLy8vOTNkM2NEQXdJYUdoZ1FFQlAvLy93QUFBQ0g1QkFFQUFBWUFMQUFBQUFBVUFCUUFBIjtpOjM0O3M6MTYwOiJwcmludCgoaXNfcmVhZGFibGUoJGYpICYmIGlzX3dyaXRlYWJsZSgkZikpPyI8dHI+PHRkPiIudygxKS5iKCJSIi53KDEpLmZvbnQoJ3JlZCcsJ1JXJywzKSkudygxKTooKChpc19yZWFkYWJsZSgkZikpPyI8dHI+PHRkPiIudygxKS5iKCJSIikudyg0KToiIikuKChpc193cml0YWJsIjtpOjM1O3M6MTYxOiIoJyInLCcmcXVvdDsnLCRmbikpLiciO2RvY3VtZW50Lmxpc3Quc3VibWl0KCk7XCc+Jy5odG1sc3BlY2lhbGNoYXJzKHN0cmxlbigkZm4pPmZvcm1hdD9zdWJzdHIoJGZuLDAsZm9ybWF0LTMpLicuLi4nOiRmbikuJzwvYT4nLnN0cl9yZXBlYXQoJyAnLGZvcm1hdC1zdHJsZW4oJGZuKSI7aTozNjtzOjExOiJ6ZWhpcmhhY2tlciI7aTozNztzOjM5OiJKQCFWckAqJlJIUnd+Skx3Lkd8eGxobkxKfj8xLmJ3T2J4YlB8IVYiO2k6Mzg7czo4OiJjaWhzaGVsbCI7aTozOTtzOjEyNjoiWDFORlUxTkpUMDViSjNSNGRHRjFkR2hwYmlkZElEMGdkSEoxWlRzTkNpQWdJQ0JwWmlBb0pGOVFUMU5VV3lkeWJTZGRLU0I3RFFvZ0lDQWdJQ0J6WlhSamIyOXJhV1VvSjNSNGRHRjFkR2hmSnk0a2NtMW5jbTkxY0N3Z2JXIjtpOjQwO3M6NjE6IkpIWnBjMmwwWTI5MWJuUWdQU0FrU0ZSVVVGOURUMDlMU1VWZlZrRlNVMXNpZG1semFYUnpJbDA3SUdsbUsiO2k6NDE7czo3OiJGeGM5OXNoIjtpOjQyO3M6Mzk6IldTT3NldGNvb2tpZShtZDUoJF9TRVJWRVJbJ0hUVFBfSE9TVCddKSI7aTo0MztzOjEwNzoiQ1Fib0dsN2YreGNBeVV5c3hiNW1LUzZrQVdzblJMZFMrc0tnR29aV2Rzd0xGSlpWOHRWelhzcSttZVNQSE14VEkzblNVQjRmSjJ2UjNyM09udlh0TkFxTjZ3bi9EdFRUaStDdTFVT0p3TkwiO2k6NDQ7czoxNDE6IjwvdGQ+PHRkIGlkPWZhPlsgPGEgdGl0bGU9XCJIb21lOiAnIi5odG1sc3BlY2lhbGNoYXJzKHN0cl9yZXBsYWNlKCJcIiwgJHNlcCwgZ2V0Y3dkKCkpKS4iJy5cIiBpZD1mYSBocmVmPVwiamF2YXNjcmlwdDpWaWV3RGlyKCciLnJhd3VybGVuY29kZSI7aTo0NTtzOjE2OiJDb250ZW50LVR5cGU6ICRfIjtpOjQ2O3M6ODY6Ijxub2JyPjxiPiRjZGlyJGNmaWxlPC9iPiAoIi4kZmlsZVsic2l6ZV9zdHIiXS4iKTwvbm9icj48L3RkPjwvdHI+PGZvcm0gbmFtZT1jdXJyX2ZpbGU+IjtpOjQ3O3M6NDg6Indzb0V4KCd0YXIgY2Z6diAnIC4gZXNjYXBlc2hlbGxhcmcoJF9QT1NUWydwMiddKSI7aTo0ODtzOjIxOiJldmFsKGJhc2U2NF9kZWNvZGUoJF8iO2k6NDk7czoxNDI6IjVqYjIwaUtXOXlJSE4wY21semRISW9KSEpsWm1WeVpYSXNJbUZ3YjNKMElpa2diM0lnYzNSeWFYTjBjaWdrY21WbVpYSmxjaXdpYm1sbmJXRWlLU0J2Y2lCemRISnBjM1J5S0NSeVpXWmxjbVZ5TENKM1pXSmhiSFJoSWlrZ2IzSWdjM1J5YVhOMGNpZ2siO2k6NTA7czo3NjoiTFMwZ1JIVnRjRE5rSUdKNUlGQnBjblZzYVc0dVVFaFFJRmRsWW5Ob00yeHNJSFl4TGpBZ1l6QmtaV1FnWW5rZ2NqQmtjakVnT2t3PSI7aTo1MTtzOjY1OiJpZiAoZXJlZygnXltbOmJsYW5rOl1dKmNkW1s6Ymxhbms6XV0rKFteO10rKSQnLCAkY29tbWFuZCwgJHJlZ3MpKSI7aTo1MjtzOjExMDoidnp2NmQraU92dGtkMzhUbEh1OG1RYXZYZG5KQ2JwUWNwWGhOYmJMbVpPcU1vcERaZU5hbGIrVktsZWRoQ2pwVkFNUVNRbnhWSUVDUUFmTHU1S2dMbXdCNmVoUVFHTlNCWWpwZzlnNUdkQmloWG8iO2k6NTM7czo0Njoicm91bmQoMCs5ODMwLjQrOTgzMC40Kzk4MzAuNCs5ODMwLjQrOTgzMC40KSk9PSI7aTo1NDtzOjEyOiJQSFBTSEVMTC5QSFAiO2k6NTU7czoxMjc6InFoRFRaSXBNY0IxeEJvazMzMkJqY2NmUFhxMFFzWlUvZzRlYXBCeFQ1Z2l0MXJHZEt0d2YxcnQ5T09pY2MvaFRscGVGbUVqUlJrV0dXVEpUa0NvbDBYNEF1d0pTZkZodGZQNWRPZ241NjFpbCt3a3prcUNHOWRmVDl6cWMyNzQiO2k6NTY7czoxMjA6IlRzTkNpQWdJQ0J6YVc0dWMybHVYMlpoYldsc2VTQTlJRUZHWDBsT1JWUTdEUW9nSUNBZ2MybHVMbk5wYmw5d2IzSjBJRDBnYUhSdmJuTW9ZWFJ2YVNoaGNtZDJXekpkS1NrN0RRb2dJQ0FnYzJsdUxuTnBibDloWiI7aTo1NztzOjUyOiJhSFIwY0Rvdkwyb3RaR1YyTG5KMUwybHVaR1Y0TG5Cb2NEOWpjRzQ5Wm5KaGJXVnpaV3hzIjtpOjU4O3M6ODc6IldUSlRrQ29sMFg0QXV3SlNmRmh0ZlA1ZE9nbjU2MWlsK3dremtxQ0c5ZGZUOXpxYzI3NHZlSWVTZDQxQ3hVSXZIRm4rdFc3N29FM29ocVN2MDFCWHpUMCI7aTo1OTtzOjcxOiJIQnliM1J2S1NCOGZDQmthV1VvSWtWeWNtOXlPaUFrSVZ4dUlpazdEUXBqYjI1dVpXTjBLRk5QUTB0RlZDd2dKSEJoWkdSeSI7aTo2MDtzOjE3OiJXZWIgU2hlbGwgYnkgYm9mZiI7aTo2MTtzOjE2OiJXZWIgU2hlbGwgYnkgb1JiIjtpOjYyO3M6MTE6ImRldmlselNoZWxsIjtpOjYzO3M6MjA6IlNoZWxsIGJ5IE1hd2FyX0hpdGFtIjtpOjY0O3M6ODoiTjN0c2hlbGwiO2k6NjU7czoxMToiU3Rvcm03U2hlbGwiO2k6NjY7czoxMToiTG9jdXM3U2hlbGwiO2k6Njc7czoyMjoicHJpdmF0ZSBTaGVsbCBieSBtNHJjbyI7aTo2ODtzOjEzOiJ3NGNrMW5nIHNoZWxsIjtpOjY5O3M6MjE6IkZhVGFMaXNUaUN6X0Z4IEZ4MjlTaCI7aTo3MDtzOjEyOiJyNTdzaGVsbC5waHAiO2k6NzE7czoyNzoiZGVmYXVsdF9hY3Rpb24gPSAnRmlsZXNNYW4nIjtpOjcyO3M6NDI6Ildvcmtlcl9HZXRSZXBseUNvZGUoJG9wRGF0YVsncmVjdkJ1ZmZlciddKSI7aTo3MztzOjQwOiIkZmlsZXBhdGg9QHJlYWxwYXRoKCRfUE9TVFsnZmlsZXBhdGgnXSk7IjtpOjc0O3M6OToiYW50aXNoZWxsIjtpOjc1O3M6OToicm9vdHNoZWxsIjtpOjc2O3M6MTE6Im15c2hlbGxleGVjIjtpOjc3O3M6ODg6IiRyZWRpcmVjdFVSTD0naHR0cDovLycuJHJTaXRlLiRfU0VSVkVSWydSRVFVRVNUX1VSSSddO2lmKGlzc2V0KCRfU0VSVkVSWydIVFRQX1JFRkVSRVInXSkiO2k6Nzg7czoxMzU6IjQwVWVDS2RCOEVPcW1YQ0tlRzNxVTBZaUJqc0dXclVIbXdMR1Fnck5vdXlYRUo5TjR0alZ2clNRQUZEcURuVkhHOXZEWnlCRnZ3NGNUR0pvcS9QRkNVc3pJU3RDVFl6MlpiTGtUS3d2ZU1Wc05PQWZLTEkybkFva3prOUkzWmpsN3BBZUJqbiI7aTo3OTtzOjg4OiJJV2x1SGpLcHg3L1hHcUtjSDFHSEUyMDlMeHlpTkt6NVRLQ296SlhpcXVOdE9BeDNEeDRHS3pOVm5mVVNSL3NIOENUQWw1cTd3b2Rhb2pPM3YrdkNEZUdFIjtpOjgwO3M6MTAzOiJkSFV1MGRKV1ZzZ0RlMnJmZTRnV0J0aUxWYzVqa3BvMUxUOExxbWVYZVd6U1hWOUY0SUJVOGkzQmNvZUFyUG9QbW5nUi9DWWI3NTJmY1M5cEdBampGRkgwamRJS3ZqNGhNWk5ueVZVIjtpOjgxO3M6MTc6InJlbmFtZSgid3NvLnBocCIsIjtpOjgyO3M6NTQ6IiRNZXNzYWdlU3ViamVjdCA9IGJhc2U2NF9kZWNvZGUoJF9QT1NUWyJtc2dzdWJqZWN0Il0pOyI7aTo4MztzOjg2OiIwaVpHbHpjR3hoZVRwdWIyNWxJajQ4WVNCb2NtVm1QU0pvZEhSd09pOHZkM2QzTG1wdmIyMXNZWGgwWXk1amIyMGlQa3B2YjIxc1lWaFVReUJPWlhkeiI7aTo4NDtzOjQ5OiJqVk50VDl0QURQNCthZjhoUXhOdEJXMGhnUVFFYkt0S1lQc3lvUTcycFltcWEyS2FvIjtpOjg1O3M6NDQ6ImNvcHkoJF9GSUxFU1t4XVt0bXBfbmFtZV0sJF9GSUxFU1t4XVtuYW1lXSkpIjtpOjg2O3M6ODoiU2hlbGwgT2siO2k6ODc7czo5MzoiSWlrN0RRcGpiMjV1WldOMEtGTlBRMHRGVkN3Z0pIQmhaR1J5S1NCOGZDQmthV1VvSWtWeWNtOXlPaUFrSVZ4dUlpazdEUXB2Y0dWdUtGTlVSRWxPTENBaVBpWlRUIjtpOjg4O3M6NTg6IlNFTEVDVCAxIEZST00gbXlzcWwudXNlciBXSEVSRSBjb25jYXQoYHVzZXJgLCAnQCcsIGBob3N0YCkiO2k6ODk7czoyMToiIUAkX0NPT0tJRVskc2Vzc2R0X2tdIjtpOjkwO3M6Nzk6IjRZVFppTnpNeU0yVXdNakExWkdReE5UYzBaR0ZrTVdaaVpUMGlYSGcyWmlJN0pHMDVOemswWVRZME9XRXpZV1F6WkRnNU9UQmxPV0ppWWoiO2k6OTE7czo0ODoiJGE9KHN1YnN0cih1cmxlbmNvZGUocHJpbnRfcihhcnJheSgpLDEpKSw1LDEpLmMpIjtpOjkyO3M6NTY6InhoIC1zICIvdXNyL2xvY2FsL2FwYWNoZS9zYmluL2h0dHBkIC1EU1NMIiAuL2h0dHBkIC1tICQxIjtpOjkzO3M6MTg6InB3ZCA+IEdlbmVyYXNpLmRpciI7aTo5NDtzOjEyOiJCUlVURUZPUkNJTkciO2k6OTU7czozMToiQ2F1dGFtIGZpc2llcmVsZSBkZSBjb25maWd1cmFyZSI7aTo5NjtzOjI0OiJldmFsKGd6aW5mbGF0ZShzdHJfcm90MTMiO2k6OTc7czo0MzoibXVpV3I0VG1MYVB3UW9KRVNnTG9BblFTdjkzYXhxaGpSbU9BRE1vRjNaTCI7aTo5ODtzOjMyOiIka2E9Jzw/Ly9CUkUnOyRrYWthPSRrYS4nQUNLLy8/PiI7aTo5OTtzOjg1OiIkc3Viaj11cmxkZWNvZGUoJF9HRVRbJ3N1J10pOyRib2R5PXVybGRlY29kZSgkX0dFVFsnYm8nXSk7JHNkcz11cmxkZWNvZGUoJF9HRVRbJ3NkJ10pIjtpOjEwMDtzOjM5OiIkX19fXz1AZ3ppbmZsYXRlKCRfX19fKSl7aWYoaXNzZXQoJF9QT1MiO2k6MTAxO3M6Mzc6InBhc3N0aHJ1KGdldGVudigiSFRUUF9BQ0NFUFRfTEFOR1VBR0UiO2k6MTAyO3M6ODoiQXNtb2RldXMiO2k6MTAzO3M6NTA6ImZvcig7JHBhZGRyPWFjY2VwdChDTElFTlQsIFNFUlZFUik7Y2xvc2UgQ0xJRU5UKSB7IjtpOjEwNDtzOjU5OiIkaXppbmxlcjI9c3Vic3RyKGJhc2VfY29udmVydChAZmlsZXBlcm1zKCRmbmFtZSksMTAsOCksLTQpOyI7aToxMDU7czo0MjoiJGJhY2tkb29yLT5jY29weSgkY2ZpY2hpZXIsJGNkZXN0aW5hdGlvbik7IjtpOjEwNjtzOjIzOiJ7JHtwYXNzdGhydSgkY21kKX19PGJyPiI7aToxMDc7czoyOToiJGFbaGl0c10nKTsgXHJcbiNlbmRxdWVyeVxyXG4iO2k6MTA4O3M6MjY6Im5jZnRwcHV0IC11ICRmdHBfdXNlcl9uYW1lIjtpOjEwOTtzOjE0OiJleGVjKCJybSAtciAtZiI7aToxMTA7czozNjoiZXhlY2woIi9iaW4vc2giLCJzaCIsIi1pIiwoY2hhciopMCk7IjtpOjExMTtzOjMxOiI8SFRNTD48SEVBRD48VElUTEU+Y2dpLXNoZWxsLnB5IjtpOjExMjtzOjM4OiJzeXN0ZW0oInVuc2V0IEhJU1RGSUxFOyB1bnNldCBTQVZFSElTVCI7aToxMTM7czoyMzoiJGxvZ2luPUBwb3NpeF9nZXR1aWQoKTsiO2k6MTE0O3M6NjA6IihlcmVnKCdeW1s6Ymxhbms6XV0qY2RbWzpibGFuazpdXSokJywgJF9SRVFVRVNUWydjb21tYW5kJ10pKSI7aToxMTU7czoyNToiISRfUkVRVUVTVFsiYzk5c2hfc3VybCJdKSI7aToxMTY7czo1MzoiUG5WbGtXTTYzIUAjQCZkS3h+bk1EV01+RH8vRXNufnh/NkRAI0AmUH5+LD9uWSxXUHtQb2oiO2k6MTE3O3M6MzY6InNoZWxsX2V4ZWMoJF9QT1NUWydjbWQnXSAuICIgMj4mMSIpOyI7aToxMTg7czozNToiaWYoISR3aG9hbWkpJHdob2FtaT1leGVjKCJ3aG9hbWkiKTsiO2k6MTE5O3M6NjE6IlB5U3lzdGVtU3RhdGUuaW5pdGlhbGl6ZShTeXN0ZW0uZ2V0UHJvcGVydGllcygpLCBudWxsLCBhcmd2KTsiO2k6MTIwO3M6MzY6IjwlPWVudi5xdWVyeUhhc2h0YWJsZSgidXNlci5uYW1lIiklPiI7aToxMjE7czo4MzoiaWYgKGVtcHR5KCRfUE9TVFsnd3NlciddKSkgeyR3c2VyID0gIndob2lzLnJpcGUubmV0Ijt9IGVsc2UgJHdzZXIgPSAkX1BPU1RbJ3dzZXInXTsiO2k6MTIyO3M6OTE6ImlmIChtb3ZlX3VwbG9hZGVkX2ZpbGUoJF9GSUxFU1snZmlsYSddWyd0bXBfbmFtZSddLCAkY3VyZGlyLiIvIi4kX0ZJTEVTWydmaWxhJ11bJ25hbWUnXSkpIHsiO2k6MTIzO3M6MTE6Ii9ldGMvcGFzc3dkIjtpOjEyNDtzOjExOiIvdmFyL2NwYW5lbCI7aToxMjU7czoxMDoiL2V0Yy9odHRwZCI7aToxMjY7czoyMzoic2hlbGxfZXhlYygndW5hbWUgLWEnKTsiO2k6MTI3O3M6MTU6Ii9ldGMvbmFtZWQuY29uZiI7aToxMjg7czo0NzoiaWYgKCFkZWZpbmVkJHBhcmFte2NtZH0peyRwYXJhbXtjbWR9PSJscyAtbGEifTsiO2k6MTI5O3M6NTE6IiRtZXNzYWdlID0gZXJlZ19yZXBsYWNlKCIlNUMlMjIiLCAiJTIyIiwgJG1lc3NhZ2UpOyI7aToxMzA7czoxOToicHJpbnQgIlNwYW1lZCc+PGJyPiI7aToxMzE7czo2MDoiaWYoZ2V0X21hZ2ljX3F1b3Rlc19ncGMoKSkkc2hlbGxPdXQ9c3RyaXBzbGFzaGVzKCRzaGVsbE91dCk7IjtpOjEzMjtzOjg0OiI8YSBocmVmPSckUEhQX1NFTEY/YWN0aW9uPXZpZXdTY2hlbWEmZGJuYW1lPSRkYm5hbWUmdGFibGVuYW1lPSR0YWJsZW5hbWUnPlNjaGVtYTwvYT4iO2k6MTMzO3M6NjY6InBhc3N0aHJ1KCAkYmluZGlyLiJteXNxbGR1bXAgLS11c2VyPSRVU0VSTkFNRSAtLXBhc3N3b3JkPSRQQVNTV09SRCI7aToxMzQ7czo2NjoibXlzcWxfcXVlcnkoIkNSRUFURSBUQUJMRSBgeHBsb2l0YCAoYHhwbG9pdGAgTE9OR0JMT0IgTk9UIE5VTEwpIik7IjtpOjEzNTtzOjQwOiJzZXRjb29raWUoICJteXNxbF93ZWJfYWRtaW5fdXNlcm5hbWUiICk7IjtpOjEzNjtzOjg3OiIkcmE0NCAgPSByYW5kKDEsOTk5OTkpOyRzajk4ID0gInNoLSRyYTQ0IjskbWwgPSAiJHNkOTgiOyRhNSA9ICRfU0VSVkVSWydIVFRQX1JFRkVSRVInXTsiO2k6MTM3O3M6NTI6IiRfRklMRVNbJ3Byb2JlJ11bJ3NpemUnXSwgJF9GSUxFU1sncHJvYmUnXVsndHlwZSddKTsiO2k6MTM4O3M6NzE6InN5c3RlbSgiJGNtZCAxPiAvdG1wL2NtZHRlbXAgMj4mMTsgY2F0IC90bXAvY21kdGVtcDsgcm0gL3RtcC9jbWR0ZW1wIik7IjtpOjEzOTtzOjM3OiJlbHNlaWYoZnVuY3Rpb25fZXhpc3RzKCJzaGVsbF9leGVjIikpIjtpOjE0MDtzOjY5OiJ9IGVsc2lmICgkc2VydmFyZyA9fiAvXlw6KC4rPylcISguKz8pXEAoLis/KSBQUklWTVNHICguKz8pIFw6KC4rKS8pIHsiO2k6MTQxO3M6Njk6InNlbmQoU09DSzUsICRtc2csIDAsIHNvY2thZGRyX2luKCRwb3J0YSwgJGlhZGRyKSkgYW5kICRwYWNvdGVze299Kys7OyI7aToxNDI7czoxODoiJGZlKCIkY21kICAyPiYxIik7IjtpOjE0MztzOjY4OiJ3aGlsZSAoJHJvdyA9IG15c3FsX2ZldGNoX2FycmF5KCRyZXN1bHQsTVlTUUxfQVNTT0MpKSBwcmludF9yKCRyb3cpOyI7aToxNDQ7czo1MjoiZWxzZWlmKEBpc193cml0YWJsZSgkRk4pICYmIEBpc19maWxlKCRGTikpICR0bXBPdXRNRiI7aToxNDU7czo3MjoiY29ubmVjdChTT0NLRVQsIHNvY2thZGRyX2luKCRBUkdWWzFdLCBpbmV0X2F0b24oJEFSR1ZbMF0pKSkgb3IgZGllIHByaW50IjtpOjE0NjtzOjg5OiJpZihtb3ZlX3VwbG9hZGVkX2ZpbGUoJF9GSUxFU1siZmljIl1bInRtcF9uYW1lIl0sZ29vZF9saW5rKCIuLyIuJF9GSUxFU1siZmljIl1bIm5hbWUiXSkpKSI7aToxNDc7czo4NzoiVU5JT04gU0VMRUNUICcwJyAsICc8PyBzeXN0ZW0oXCRfR0VUW2NwY10pO2V4aXQ7ID8+JyAsMCAsMCAsMCAsMCBJTlRPIE9VVEZJTEUgJyRvdXRmaWxlIjtpOjE0ODtzOjY4OiJpZiAoIUBpc19saW5rKCRmaWxlKSAmJiAoJHIgPSByZWFscGF0aCgkZmlsZSkpICE9IEZBTFNFKSAkZmlsZSA9ICRyOyI7aToxNDk7czoyOToiZWNobyAiRklMRSBVUExPQURFRCBUTyAkZGV6IjsiO2k6MTUwO3M6MjQ6IiRmdW5jdGlvbigkX1BPU1RbJ2NtZCddKSI7aToxNTE7czo1OToiPCUjQH5eSHdBQUFBPT1AI0AmRG5rd0t4L39Sf1VOQCNAJm54OVBkOyhAI0AmdWdjQUFBPT1eI35AJT4iO2k6MTUyO3M6Mzg6IiRmaWxlbmFtZSA9ICRiYWNrdXBzdHJpbmcuIiRmaWxlbmFtZSI7IjtpOjE1MztzOjQ4OiJpZignJz09KCRkZj1AaW5pX2dldCgnZGlzYWJsZV9mdW5jdGlvbnMnKSkpe2VjaG8iO2k6MTU0O3M6Njc6ImRvY3VtZW50LndyaXRlKHVuZXNjYXBlKCclM0MlNjglNzQlNkQlNkMlM0UlM0MlNjIlNkYlNjQlNzklM0UlM0MlNTMiO2k6MTU1O3M6NDY6IjwlIEZvciBFYWNoIFZhcnMgSW4gUmVxdWVzdC5TZXJ2ZXJWYXJpYWJsZXMgJT4iO2k6MTU2O3M6MzM6ImlmICgkZnVuY2FyZyA9fiAvXnBvcnRzY2FuICguKikvKSI7aToxNTc7czo1NToiJHVwbG9hZGZpbGUgPSAkcnBhdGguIi8iIC4gJF9GSUxFU1sndXNlcmZpbGUnXVsnbmFtZSddOyI7aToxNTg7czoyNjoiJGNtZCA9ICgkX1JFUVVFU1RbJ2NtZCddKTsiO2k6MTU5O3M6Mzg6ImlmKCRjbWQgIT0gIiIpIHByaW50IFNoZWxsX0V4ZWMoJGNtZCk7IjtpOjE2MDtzOjI5OiJpZiAoaXNfZmlsZSgiL3RtcC8kZWtpbmNpIikpeyI7aToxNjE7czo2OToiX19hbGxfXyA9IFsiU01UUFNlcnZlciIsIkRlYnVnZ2luZ1NlcnZlciIsIlB1cmVQcm94eSIsIk1haWxtYW5Qcm94eSJdIjtpOjE2MjtzOjU5OiJnbG9iYWwgJG15c3FsSGFuZGxlLCAkZGJuYW1lLCAkdGFibGVuYW1lLCAkb2xkX25hbWUsICRuYW1lLCI7aToxNjM7czoyNzoiMj4mMSAxPiYyIiA6ICIgMT4mMSAyPiYxIik7IjtpOjE2NDtzOjUyOiJtYXAgeyByZWFkX3NoZWxsKCRfKSB9ICgkc2VsX3NoZWxsLT5jYW5fcmVhZCgwLjAxKSk7IjtpOjE2NTtzOjIyOiJmd3JpdGUgKCRmcCwgIiR5YXppIik7IjtpOjE2NjtzOjUxOiJTZW5kIHRoaXMgZmlsZTogPElOUFVUIE5BTUU9InVzZXJmaWxlIiBUWVBFPSJmaWxlIj4iO2k6MTY3O3M6NDI6IiRkYl9kID0gQG15c3FsX3NlbGVjdF9kYigkZGF0YWJhc2UsJGNvbjEpOyI7aToxNjg7czo1OToiaWYgKGlzX2NhbGxhYmxlKCJleGVjIikgYW5kICFpbl9hcnJheSgiZXhlYyIsJGRpc2FibGVmdW5jKSkiO2k6MTY5O3M6MzQ6ImlmICgoJHBlcm1zICYgMHhDMDAwKSA9PSAweEMwMDApIHsiO2k6MTcwO3M6Njc6ImZvciAoJHZhbHVlKSB7IHMvJi8mYW1wOy9nOyBzLzwvJmx0Oy9nOyBzLz4vJmd0Oy9nOyBzLyIvJnF1b3Q7L2c7IH0iO2k6MTcxO3M6MTA6ImRpciAvT0cgL1giO2k6MTcyO3M6NjoibHMgLWxhIjtpOjE3MztzOjc0OiJjb3B5KCRfRklMRVNbJ3Vwa2snXVsndG1wX25hbWUnXSwia2svIi5iYXNlbmFtZSgkX0ZJTEVTWyd1cGtrJ11bJ25hbWUnXSkpOyI7aToxNzQ7czoxMTM6IlpuVnVZM1JwYjI0Z2VHTmpLQ1J3TENSNFBUTXhOVE0yTURBd0tYc2dKR1lnUFNCQVptbHNaVzEwYVcxbEtDUndLVHNnSkdOeWIyNGdQU0IwYVcxbEtDa2dMU0FrWmpzZ0pHUWdQU0JBWm1sc1pWOW5aIjtpOjE3NTtzOjg2OiJmdW5jdGlvbiBnb29nbGVfYm90KCkgeyRzVXNlckFnZW50ID0gc3RydG9sb3dlcigkX1NFUlZFUlsnSFRUUF9VU0VSX0FHRU5UJ10pO2lmKCEoc3RycCI7aToxNzY7czoxNjoiZXZhMWZZbGJha0JjVlNpciI7aToxNzc7czo3NToiY3JlYXRlX2Z1bmN0aW9uKCImJCIuImZ1bmN0aW9uIiwiJCIuImZ1bmN0aW9uID0gY2hyKG9yZCgkIi4iZnVuY3Rpb24pLTMpOyIpIjtpOjE3ODtzOjQ2OiJsb25nIGludDp0KDAsMyk9cigwLDMpOy0yMTQ3NDgzNjQ4OzIxNDc0ODM2NDc7IjtpOjE3OTtzOjQ2OiI/dXJsPScuJF9TRVJWRVJbJ0hUVFBfSE9TVCddKS51bmxpbmsoUk9PVF9ESVIuIjtpOjE4MDtzOjM2OiJjYXQgJHtibGtsb2dbMl19IHwgZ3JlcCAicm9vdDp4OjA6MCIiO2k6MTgxO3M6OTc6IkBwYXRoMT0oJ2FkbWluLycsJ2FkbWluaXN0cmF0b3IvJywnbW9kZXJhdG9yLycsJ3dlYmFkbWluLycsJ2FkbWluYXJlYS8nLCdiYi1hZG1pbi8nLCdhZG1pbkxvZ2luLyciO2k6MTgyO3M6ODc6IiJhZG1pbjEucGhwIiwgImFkbWluMS5odG1sIiwgImFkbWluMi5waHAiLCAiYWRtaW4yLmh0bWwiLCAieW9uZXRpbS5waHAiLCAieW9uZXRpbS5odG1sIiI7aToxODM7czozMToiZmluZCAvIC10eXBlIGYgLXBlcm0gLTA0MDAwIC1scyI7aToxODQ7czozMToiZmluZCAvIC10eXBlIGYgLXBlcm0gLTAyMDAwIC1scyI7aToxODU7czozMDoiZmluZCAvIC10eXBlIGYgLW5hbWUgLmh0cGFzc3dkIjtpOjE4NjtzOjY4OiJQT1NUIHskcGF0aH17JGNvbm5lY3Rvcn0/Q29tbWFuZD1GaWxlVXBsb2FkJlR5cGU9RmlsZSZDdXJyZW50Rm9sZGVyPSI7aToxODc7czozMDoiQGFzc2VydCgkX1JFUVVFU1RbJ1BIUFNFU1NJRCddIjtpOjE4ODtzOjg6InJvdW5kKDArIjtpOjE4OTtzOjM5OiJldmFsKGJhc2U2NF9kZWNvZGUoJ2NHaHdhVzVtYnlncE93PT0nKSkiO2k6MTkwO3M6NjE6IiRwcm9kPSJzeSIuInMiLiJ0ZW0iOyRpZD0kcHJvZCgkX1JFUVVFU1RbJ3Byb2R1Y3QnXSk7JHsnaWQnfTsiO2k6MTkxO3M6MTU6InBocCAiLiR3c29fcGF0aCI7aToxOTI7czo3NzoiJEZjaG1vZCwkRmRhdGEsJE9wdGlvbnMsJEFjdGlvbiwkaGRkYWxsLCRoZGRmcmVlLCRoZGRwcm9jLCR1bmFtZSwkaWRkKTpzaGFyZWQiO2k6MTkzO3M6NDM6Ik9ERTFORFZqWkdReVpHRXhOR1k1WmpRNE9XRmxOV0V3TWpGa09XRXpOakUiO2k6MTk0O3M6NTE6InNlcnZlci48L3A+XHJcbjwvYm9keT48L2h0bWw+IjtleGl0O31pZihwcmVnX21hdGNoKCI7aToxOTU7czo3NDoiZTVXclBZTk01dURVQzJ3cnNaSHlSTFNEZzF5V1NtTXpQY3pXbUZGQUZxR1IwRVRjcmZhNU1TUWVDY0hCRWM1Y2twWlI2Q3JXdjEiO2k6MTk2O3M6Njk6IkQxMCsrM3FCbkhmeWgxaUk1dFp2NnZXaU8xaFZRdkRaNWNyS1YwTHR1eW8zcXczY0FnTXV6QjZMWEFSQlM3SWU5QlR4bSI7aToxOTc7czoxMDoiZXZhbCgkX0dFVCI7aToxOTg7czoxMToiZXZhbCgkX1BPU1QiO2k6MTk5O3M6MTQ6ImV2YWwoJF9SRVFVRVNUIjtpOjIwMDtzOjEzOiJldmFsKCRfQ09PS0lFIjtpOjIwMTtzOjEyOiJhc3NlcnQoJF9HRVQiO2k6MjAyO3M6MTM6ImFzc2VydCgkX1BPU1QiO2k6MjAzO3M6MTY6ImFzc2VydCgkX1JFUVVFU1QiO2k6MjA0O3M6MTU6ImFzc2VydCgkX0NPT0tJRSI7aToyMDU7czoxNjoiaW5jbHVkZSgkX0NPT0tJRSI7aToyMDY7czoxMzoiaW5jbHVkZSgkX0dFVCI7aToyMDc7czoxNDoiaW5jbHVkZSgkX1BPU1QiO2k6MjA4O3M6MTY6ImluY2x1ZGUoJ2ltYWdlcy8iO2k6MjA5O3M6MTY6ImluY2x1ZGUoImltYWdlcy8iO2k6MjEwO3M6MTM6InN5c3RlbSgkX0dFVFsiO2k6MjExO3M6MTQ6InN5c3RlbSgkX1BPU1RbIjtpOjIxMjtzOjE3OiJzeXN0ZW0oJF9SRVFVRVNUWyI7aToyMTM7czo3MToiUDJsQ1Axb3VXZzFXYzBFb0pGOURTMVJxSjNOSVFVOG5aRDVUVXo0bmMxbDRKeWsrWFExV0xrMWxPVTE2S0NJdlQwZzlUVWciO2k6MjE0O3M6ODM6ImlWQk9SdzBLR2dvQUFBQU5TVWhFVWdBQUFBb0FBQUFJQ0FZQUFBREEtbTYyQUFBQUFYTlNSMElBcnM0YzZRQUFBQVJuUVUxQkFBQ3hqd3Y4WVFVIjtpOjIxNTtzOjUxOiJMejhfTHk4dkR4OGVfdjctN3U3dTNzN3V6czdPenE2dW5xN2VycTZ1dnE1LWpvNnVqbjUiO2k6MjE2O3M6NDg6IkRKN1ZJVTdSSUNYcjZzRUVWMmNCdEhEU09lOW5WZHBFR2hFbXZSVlJOVVJmdzF3USI7aToyMTc7czo5NToiJGZpbGUgPSAkX0ZJTEVTWyJmaWxlbmFtZSJdWyJuYW1lIl07IGVjaG8gIjxhIGhyZWY9XCIkZmlsZVwiPiRmaWxlPC9hPiI7fSBlbHNlIHtlY2hvKCJlbXB0eSIpO30iO2k6MjE4O3M6NDk6Ikx5ODNNVGczT1dReU1USmtZemhqWW1ZMFpEUm1aREEwTkdFelpERTNaamszWm1JMk4iO2k6MjE5O3M6NjA6IkZTX2Noa19mdW5jX2xpYmM9KCAkKHJlYWRlbGYgLXMgJEZTX2xpYmMgfCBncmVwIF9jaGtAQCB8IGF3ayI7aToyMjA7czo0MDoiZmluZCAvIC1uYW1lIC5zc2ggPiAkZGlyL3NzaGtleXMvc3Noa2V5cyI7aToyMjE7czozMzoicmUuZmluZGFsbChkaXJ0KycoLiopJyxwcm9nbm0pWzBdIjtpOjIyMjtzOjYxOiJRT2lLV0FnVjYxM0x2c3RLWStVQjk4SlpUUkdJaFlCZEh1SkNBd20rWHRoMTZBd1E4WDR0UE1jTVZaUXRlIjtpOjIyMztzOjM2OiJpbmNsdWRlKCRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXSkiO2k6MjI0O3M6NjA6Im91dHN0ciArPSBzdHJpbmcuRm9ybWF0KCI8YSBocmVmPSc/ZmRpcj17MH0nPnsxfS88L2E+Jm5ic3A7IiI7aToyMjU7czo4MzoiPCU9UmVxdWVzdC5TZXJ2ZXJ2YXJpYWJsZXMoIlNDUklQVF9OQU1FIiklPj90eHRwYXRoPTwlPVJlcXVlc3QuUXVlcnlTdHJpbmcoInR4dHBhdGgiO2k6MjI2O3M6NzE6IlJlc3BvbnNlLldyaXRlKFNlcnZlci5IdG1sRW5jb2RlKHRoaXMuRXhlY3V0ZUNvbW1hbmQodHh0Q29tbWFuZC5UZXh0KSkpIjtpOjIyNztzOjExMToibmV3IEZpbGVTdHJlYW0oUGF0aC5Db21iaW5lKGZpbGVJbmZvLkRpcmVjdG9yeU5hbWUsIFBhdGguR2V0RmlsZU5hbWUoaHR0cFBvc3RlZEZpbGUuRmlsZU5hbWUpKSwgRmlsZU1vZGUuQ3JlYXRlIjtpOjIyODtzOjkwOiJSZXNwb25zZS5Xcml0ZSgiPGJyPiggKSA8YSBocmVmPT90eXBlPTEmZmlsZT0iICYgc2VydmVyLlVSTGVuY29kZShpdGVtLnBhdGgpICYgIlw+IiAmIGl0ZW0iO2k6MjI5O3M6MTA0OiJzcWxDb21tYW5kLlBhcmFtZXRlcnMuQWRkKCgoVGFibGVDZWxsKWRhdGFHcmlkSXRlbS5Db250cm9sc1swXSkuVGV4dCwgU3FsRGJUeXBlLkRlY2ltYWwpLlZhbHVlID0gZGVjaW1hbCI7aToyMzA7czo2NDoiPCU9ICJcIiAmIG9TY3JpcHROZXQuQ29tcHV0ZXJOYW1lICYgIlwiICYgb1NjcmlwdE5ldC5Vc2VyTmFtZSAlPiI7aToyMzE7czo1ODoiM0hqcXhjbGtaZnBXYjFTd3p3VG1wMUtZREFldytURnQ0SDNqNTlrelc2ZWRNUm5MUDMvdFlTQlBtZiI7aToyMzI7czo3MToiNW9IblJuNmlkb3pOeGtVNmhoZGF1THlieTZMSXF4V1ZSUWRKblcxcUhIZU1SbDU5TTJTcXczRGtCVXpWOEtLbTFwclk5V1giO2k6MjMzO3M6NzI6ImJNRml1YlJ3SXpxaUhoa1BrSWFwVFIzZFZENUFva3E4bVJGZE1ta1BVWGpXUlNjSi9XZlJmTHBQUGJHeThndGlVcGx1b2cwZCI7aToyMzQ7czozOToidGFvT0k4dXlMYnpJU0xJTjlGc1hkSzdoKy9kZDJZbklSVW90QmxOIjtpOjIzNTtzOjE2OiJzeXN0ZW0oIndob2FtaSIpIjtpOjIzNjtzOjUwOiJjdXJsX3NldG9wdCgkY2gsIENVUkxPUFRfVVJMLCAiaHR0cDovLyRob3N0OjIwODIiKSI7aToyMzc7czo1ODoiSEozSGp1dGNrb1JmcFhmOUExelFPMkF3RFJyUmV5OXVHdlRlZXo3OXFBYW8xYTByZ3Vka1prUjhSYSI7aToyMzg7czozMToiJGluaVsndXNlcnMnXSA9IGFycmF5KCdyb290JyA9PiI7aToyMzk7czo3OiJtaWx3MHJtIjtpOjI0MDtzOjU4OiJBQUFBQUFBQU1BQXdBQkFBQUFlQVVBQURRQUFBRHNDUUFBQUFBQUFEUUFJQUFEQUNnQUZ3QVVBQUVBIjtpOjI0MTtzOjU2OiJceDMxXHhkYlx4ZjdceGUzXHg1M1x4NDNceDUzXHg2YVx4MDJceDg5XHhlMVx4YjBceDY2XHhjZCI7aToyNDI7czoxODoicHJvY19vcGVuKCdJSFN0ZWFtIjtpOjI0MztzOjI0OiIkYmFzbGlrPSRfUE9TVFsnYmFzbGlrJ10iO2k6MjQ0O3M6MzA6ImZyZWFkKCRmcCwgZmlsZXNpemUoJGZpY2hlcm8pKSI7aToyNDU7czozNjoiOTdRRVhSQXM5OWM5OEhkam9oOXpaaVRSMTJHYXpvSlVJaUxVIjtpOjI0NjtzOjM2OiI3VmgzV0ZQWnRqOHBrRUFTRWlRSVNEc29DaWdkUmtDREpBSUMiO2k6MjQ3O3M6Mzc6IlhWRk5hd0l4RUwwTC9vZGhoWkpvY0YydjJvS0lCU210b250cloiO2k6MjQ4O3M6NTU6IjQ2MzgzOTYxMGMwMDBiMDA4MDAxMDBmZmZmZmZmZmZmZmYyMWY5MDQwMTAwMDAwMTAwMmMwMDAiO2k6MjQ5O3M6MTAyOiJcdTAwM2NcdTAwNjlcdTAwNmRcdTAwNjdcdTAwMjBcdTAwNzNcdTAwNzJcdTAwNjNcdTAwM2RcdTAwMjJcdTAwNjhcdTAwNzRcdTAwNzRcdTAwNzBcdTAwM2FcdTAwMmZcdTAwMmYiO2k6MjUwO3M6NjQ6IkZKM0ZrdVBLRmtVLzUzV0VCbUlhaXBrdG5Md1FXOHo0OWRjMXJiYkxxc3c4ZTY5bDZ2Sk0rMy8xMjR4Vm4rN2wiO2k6MjUxO3M6NDk6IidodHRwZC5jb25mJywndmhvc3RzLmNvbmYnLCdjZmcucGhwJywnY29uZmlnLnBocCciO2k6MjUyO3M6Mzk6IkkvZ2NaL3ZYMEExMEREUkRnN0V6ay9kKzMrOHF2cXFTMUswK0FYWSI7aToyNTM7czoxNjoieyRfUE9TVFsncm9vdCddfSI7aToyNTQ7czoyOToifWVsc2VpZigkX0dFVFsncGFnZSddPT0nZGRvcyciO2k6MjU1O3M6NjE6IlEzSmxaR2wwSURvZ1ZXNWtaWEpuY205MWJtUWdSR1YyYVd3Z0ptNWljM0E3SUNCOERRbzhZU0JvY21WbVAiO2k6MjU2O3M6MTQ6IlRoZSBEYXJrIFJhdmVyIjtpOjI1NztzOjM5OiIkdmFsdWUgPX4gcy8lKC4uKS9wYWNrKCdjJyxoZXgoJDEpKS9lZzsiO2k6MjU4O3M6MTE6Ind3dy50MHMub3JnIjtpOjI1OTtzOjMwOiJ1bmxlc3Mob3BlbihQRkQsJGdfdXBsb2FkX2RiKSkiO2k6MjYwO3M6MTI6ImF6ODhwaXgwMHE5OCI7aToyNjE7czoxMToic2ggZ28gJDEuJHgiO2k6MjYyO3M6MjY6InN5c3RlbSgicGhwIC1mIHhwbCAkaG9zdCIpIjtpOjI2MztzOjEzOiJleHBsb2l0Y29va2llIjtpOjI2NDtzOjIxOiI4MCAtYiAkMSAtaSBldGgwIC1zIDgiO2k6MjY1O3M6MjU6IkhUVFAgZmxvb2QgY29tcGxldGUgYWZ0ZXIiO2k6MjY2O3M6MTU6Ik5JR0dFUlMuTklHR0VSUyI7aToyNjc7czo0NzoiaWYoaXNzZXQoJF9HRVRbJ2hvc3QnXSkmJmlzc2V0KCRfR0VUWyd0aW1lJ10pKXsiO2k6MjY4O3M6ODM6InN1YnByb2Nlc3MuUG9wZW4oY21kLCBzaGVsbCA9IFRydWUsIHN0ZG91dD1zdWJwcm9jZXNzLlBJUEUsIHN0ZGVycj1zdWJwcm9jZXNzLlNURE9VIjtpOjI2OTtzOjY5OiJkZWYgZGFlbW9uKHN0ZGluPScvZGV2L251bGwnLCBzdGRvdXQ9Jy9kZXYvbnVsbCcsIHN0ZGVycj0nL2Rldi9udWxsJykiO2k6MjcwO3M6Njc6InByaW50KCJbIV0gSG9zdDogIiArIGhvc3RuYW1lICsgIiBtaWdodCBiZSBkb3duIVxuWyFdIFJlc3BvbnNlIENvZGUiO2k6MjcxO3M6NDI6ImNvbm5lY3Rpb24uc2VuZCgic2hlbGwgIitzdHIob3MuZ2V0Y3dkKCkpKyI7aToyNzI7czo1MDoib3Muc3lzdGVtKCdlY2hvIGFsaWFzIGxzPSIubHMuYmFzaCIgPj4gfi8uYmFzaHJjJykiO2k6MjczO3M6MzI6InJ1bGVfcmVxID0gcmF3X2lucHV0KCJTb3VyY2VGaXJlIjtpOjI3NDtzOjU3OiJhcmdwYXJzZS5Bcmd1bWVudFBhcnNlcihkZXNjcmlwdGlvbj1oZWxwLCBwcm9nPSJzY3R1bm5lbCIiO2k6Mjc1O3M6NTc6InN1YnByb2Nlc3MuUG9wZW4oJyVzZ2RiIC1wICVkIC1iYXRjaCAlcycgJSAoZ2RiX3ByZWZpeCwgcCI7aToyNzY7czozNDoiL3Byb2Mvc3lzL2tlcm5lbC95YW1hL3B0cmFjZV9zY29wZSI7aToyNzc7czo1OToiJGZyYW1ld29yay5wbHVnaW5zLmxvYWQoIiN7cnBjdHlwZS5kb3duY2FzZX1ycGMiLCBvcHRzKS5ydW4iO2k6Mjc4O3M6Mjg6ImlmIHNlbGYuaGFzaF90eXBlID09ICdwd2R1bXAiO2k6Mjc5O3M6MTY6ImV2YWwoZ2V0X29wdGlvbigiO2k6MjgwO3M6MTc6Iml0c29rbm9wcm9ibGVtYnJvIjtpOjI4MTtzOjQ1OiJhZGRfZmlsdGVyKCd0aGVfY29udGVudCcsICdfYmxvZ2luZm8nLCAxMDAwMSkiO2k6MjgyO3M6OToiPHN0ZGxpYi5oIjtpOjI4MztzOjU5OiJlY2hvIHkgOyBzbGVlcCAxIDsgfSB8IHsgd2hpbGUgcmVhZCA7IGRvIGVjaG8geiRSRVBMWTsgZG9uZSI7aToyODQ7czoxMToiVk9CUkEgR0FOR08iO2k6Mjg1O3M6NzY6ImludDMyKCgoJHogPj4gNSAmIDB4MDdmZmZmZmYpIF4gJHkgPDwgMikgKyAoKCR5ID4+IDMgJiAweDFmZmZmZmZmKSBeICR6IDw8IDQiO2k6Mjg2O3M6Njk6IkBjb3B5KCRfRklMRVNbZmlsZU1hc3NdW3RtcF9uYW1lXSwkX1BPU1RbcGF0aF0uJF9GSUxFU1tmaWxlTWFzc11bbmFtZSI7aToyODc7czo0NjoiZmluZF9kaXJzKCRncmFuZHBhcmVudF9kaXIsICRsZXZlbCwgMSwgJGRpcnMpOyI7aToyODg7czoyMDoicHJlZ19yZXBsYWNlKCIvLiovZSIiO2k6Mjg5O3M6MjA6InByZWdfcmVwbGFjZSgnLy4qL2UnIjtpOjI5MDtzOjIzOiJldmFsKGZpbGVfZ2V0X2NvbnRlbnRzKCI7aToyOTE7czoyODoiQHNldGNvb2tpZSgiaGl0IiwgMSwgdGltZSgpKyI7aToyOTI7czo1OiJlLyouLyI7aToyOTM7czoxMzoiZWRvY2VkXzQ2ZXNhYiI7aToyOTQ7czozNzoiSkhacGMybDBZMjkxYm5RZ1BTQWtTRlJVVUY5RFQwOUxTVVZmViI7aToyOTU7czo5OiJldGFsZm5pemciO2k6Mjk2O3M6MzU6IjBkMGEwZDBhNjc2YzZmNjI2MTZjMjAyNDZkNzk1ZjczNmQ3IjtpOjI5NztzOjIzOiJpc193cml0YWJsZSgiL3Zhci90bXAiKSI7aToyOTg7czozODoiZXZhbChnemluZmxhdGUoc3RyX3JvdDEzKGJhc2U2NF9kZWNvZGUiO2k6Mjk5O3M6MjA6ImV2YWwoc3RyaXBzbGFzaGVzKCRfIjtpOjMwMDtzOjExOiJmMFZNUmdFQkFRQSI7aTozMDE7czoxOToiZm9wZW4oJy9ldGMvcGFzc3dkJyI7aTozMDI7czo4OiJybSAtcmYgLyI7aTozMDM7czo2OiJ1ZHA6Ly8iO2k6MzA0O3M6NjoiU2VSdkFyIjtpOjMwNTtzOjc2OiIkdHN1MltyYW5kKDAsY291bnQoJHRzdTIpIC0gMSldLiR0c3UxW3JhbmQoMCxjb3VudCgkdHN1MSkgLSAxKV0uJHRzdTJbcmFuZCgwIjtpOjMwNjtzOjMzOiIvdXNyL2xvY2FsL2FwYWNoZS9iaW4vaHR0cGQgLURTU0wiO2k6MzA3O3M6MjA6InNldCBwcm90ZWN0LXRlbG5ldCAwIjtpOjMwODtzOjI3OiJheXUgcHIxIHByMiBwcjMgcHI0IHByNSBwcjYiO2k6MzA5O3M6MzA6ImJpbmQgZmlsdCAtICJcMDAxQUNUSU9OICpcMDAxIiI7aTozMTA7czo1MDoicmVnc3ViIC1hbGwgLS0gLCBbc3RyaW5nIHRvbG93ZXIgJG93bmVyXSAiIiBvd25lcnMiO2k6MzExO3M6MzU6ImtpbGwgLUNITEQgXCRib3RwaWQgPi9kZXYvbnVsbCAyPiYxIjtpOjMxMjtzOjEwOiJiaW5kIGRjYyAtIjtpOjMxMztzOjI0OiJyNGFUYy5kUG50RS9menRTRjFiSDNSSDAiO2k6MzE0O3M6MTM6InByaXZtc2cgJGNoYW4iO2k6MzE1O3M6MjI6ImJpbmQgam9pbiAtICogZ29wX2pvaW4iO2k6MzE2O3M6NDM6InNldCBnb29nbGUoZGF0YSkgW2h0dHA6OmRhdGEgJGdvb2dsZShwYWdlKV0iO2k6MzE3O3M6MjY6InByb2MgaHR0cDo6Q29ubmVjdCB7dG9rZW59IjtpOjMxODtzOjEzOiJwcml2bXNnICRuaWNrIjtpOjMxOTtzOjExOiJwdXRib3QgJGJvdCI7aTozMjA7czoxMjoidW5iaW5kIFJBVyAtIjtpOjMyMTtzOjI5OiItLURDQ0RJUiBbbGluZGV4ICRVc2VyKCRpKSAyXSI7aTozMjI7czoyNzoiL2hvbWUvbXlkaXIvZWdnZHJvcC9maWxlc3lzIjtpOjMyMztzOjE4OiJ0aW1lKCkgLSAxMDUyMDAyMDAiO2k6MzI0O3M6MTQ6IiRHTE9CQUxTWydfX19fIjt9"));
$g_SusDB = unserialize(base64_decode("YTo1MDp7aTowO3M6MjA6ImluaV9nZXQoJ3NhZmVfbW9kZScpIjtpOjE7czoyMDoiaW5pX2dldCgic2FmZV9tb2RlIikiO2k6MjtzOjI4OiJldmFsKGd6aW5mbGF0ZShiYXNlNjRfZGVjb2RlIjtpOjM7czoxOToiZXZhbChiYXNlNjRfZGVjb2RlKCI7aTo0O3M6MjA6InNycGF0aDovLy4uLy4uLy4uLy4uIjtpOjU7czo3OiI8aWZyYW1lIjtpOjY7czo5OiJnemluZmxhdGUiO2k6NztzOjEyOiJnenVuY29tcHJlc3MiO2k6ODtzOjExOiJqc29uX2RlY29kZSI7aTo5O3M6OToicGhwaW5mbygpIjtpOjEwO3M6MzE6ImV2YWwoZ3p1bmNvbXByZXNzKGJhc2U2NF9kZWNvZGUiO2k6MTE7czoxODoiZXZhbChiYXNlNjRfZGVjb2RlIjtpOjEyO3M6MTQ6IlNIT1cgREFUQUJBU0VTIjtpOjEzO3M6MTQ6InBvc2l4X2dldHB3dWlkIjtpOjE0O3M6MTc6IiRkZWZhdWx0X3VzZV9hamF4IjtpOjE1O3M6MTM6ImV2YWwodW5lc2NhcGUiO2k6MTY7czoyMzoiZG9jdW1lbnQud3JpdGUodW5lc2NhcGUiO2k6MTc7czo1OiJjb3B5KCI7aToxODtzOjE4OiJtb3ZlX3VwbG9hZGVkX2ZpbGUiO2k6MTk7czoxNjoiLjMzMzMzMzMzMzMzMzMzKyI7aToyMDtzOjEzOiIuNjY2NjY2NjY2NjY3IjtpOjIxO3M6ODoicm91bmQoMCkiO2k6MjI7czoxMzoicG9zaXhfZ2V0ZXVpZCI7aToyMztzOjEzOiJwb3NpeF9nZXRldWlkIjtpOjI0O3M6NDc6ImNvcHkoJF9GSUxFU1snZmlsZSddWyd0bXBfbmFtZSddLCAkdXBsb2FkZmlsZSkpIjtpOjI1O3M6Mjg6ImluaV9nZXQoImRpc2FibGVfZnVuY3Rpb25zIikiO2k6MjY7czoyODoiaW5pX2dldCgnZGlzYWJsZV9mdW5jdGlvbnMnKSI7aToyNztzOjE2OiJVTklPTiBTRUxFQ1QgJzAnIjtpOjI4O3M6NDoiMj4mMSI7aToyOTtzOjY6IjIgPiAmMSI7aTozMDtzOjMwOiJlY2hvICRfU0VSVkVSWydET0NVTUVOVF9ST09UJ10iO2k6MzE7czoyMToiPUFycmF5KGJhc2U2NF9kZWNvZGUoIjtpOjMyO3M6MTA6ImtpbGxhbGwgLTkiO2k6MzM7czo3OiJlcml1cWVyIjtpOjM0O3M6NjoidG91Y2goIjtpOjM1O3M6Nzoic3Noa2V5cyI7aTozNjtzOjg6IkBpbmNsdWRlIjtpOjM3O3M6ODoiQHJlcXVpcmUiO2k6Mzg7czoyNjoiQGluaV9zZXQoXJFhbGxvd191cmxfZm9wZW4iO2k6Mzk7czoxODoiQGZpbGVfZ2V0X2NvbnRlbnRzIjtpOjQwO3M6MTc6ImZpbGVfcHV0X2NvbnRlbnRzIjtpOjQxO3M6MjI6ImV2YWwoZmlsZV9nZXRfY29udGVudHMiO2k6NDI7czoyNToiYW5kcm9pZHxtaWRwfGoybWV8c3ltYmlhbiI7aTo0MztzOjE2OiJAc2V0Y29va2llKCJoaXQiIjtpOjQ0O3M6MTA6IkBmaWxlb3duZXIiO2k6NDU7czo2OiI8a3VrdT4iO2k6NDY7czo1OiJzeXBleCI7aTo0NztzOjg6IkJhY2tkb29yIjtpOjQ4O3M6MTA6InBocF91bmFtZSgiO2k6NDk7czoxODoiZXZhbChiYXNlNjRfZGVjb2RlIjt9"));
$g_AdwareSig = unserialize(base64_decode("YToxMzp7aTowO3M6MTk6Il9fbGlua2ZlZWRfcm9ib3RzX18iO2k6MTtzOjEzOiJMSU5LRkVFRF9VU0VSIjtpOjI7czoxODoiX19zYXBlX2RlbGltaXRlcl9fIjtpOjM7czoyNjoiZGlzcGVuc2VyLmFydGljbGVzLnNhcGUucnUiO2k6NDtzOjExOiJMRU5LX2NsaWVudCI7aTo1O3M6MTE6IlNBUEVfY2xpZW50IjtpOjY7czoxNToiZGIudHJ1c3RsaW5rLnJ1IjtpOjc7czoxNjoidGxfbGlua3NfZGJfZmlsZSI7aTo4O3M6MTU6IlRydXN0bGlua0NsaWVudCI7aTo5O3M6MTA6Ii0+U0xDbGllbnQiO2k6MTA7czo4MDoiaXNzZXQoJF9TRVJWRVJbJ0hUVFBfVVNFUl9BR0VOVCddKSAmJiAoJF9TRVJWRVJbJ0hUVFBfVVNFUl9BR0VOVCddID09ICdMTVBfUm9ib3QiO2k6MTE7czozMToiJGxpbmtzLT5yZXR1cm5fbGlua3MoJGxpYl9wYXRoKSI7aToxMjtzOjMwOiIkbGlua3NfY2xhc3MgPSBuZXcgR2V0X2xpbmtzKCkiO30="));
$g_JSVirSig = unserialize(base64_decode("YTo0Mzp7aTowO3M6MzU6ImY9J2YnKydyJysnbycrJ20nKydDaCcrJ2FyQycrJ29kZSc7IjtpOjE7czoxOToiLnByb3RvdHlwZS5hfWNhdGNoKCI7aToyO3M6MzI6InRyeXtCb29sZWFuKCkucHJvdG90eXBlLnF9Y2F0Y2goIjtpOjM7czoyODoiaWYoUmVmLmluZGV4T2YoJy5nb29nbGUuJykhPSI7aTo0O3M6NzM6ImluZGV4T2Z8aWZ8cmN8bGVuZ3RofG1zbnx5YWhvb3xyZWZlcnJlcnxhbHRhdmlzdGF8b2dvfGJpfGhwfHZhcnxhb2x8cXVlcnkiO2k6NTtzOjQ2OiJBcnJheS5wcm90b3R5cGUuc2xpY2UuY2FsbChhcmd1bWVudHMpLmpvaW4oIiIpIjtpOjY7czo3MToicT1kb2N1bWVudC5jcmVhdGVFbGVtZW50KCJkIisiaSIrInYiKTtxLmFwcGVuZENoaWxkKHErIiIpO31jYXRjaChxdyl7aD0iO2k6NztzOjY4OiIreno7c3M9W107Zj0nZnInKydvbScrJ0NoJztmKz0nYXJDJztmKz0nb2RlJzt3PXRoaXM7ZT13W2ZbInN1YnN0ciJdKCI7aTo4O3M6MTAyOiJzNShxNSl7cmV0dXJuICsrcTU7fWZ1bmN0aW9uIHlmKHNmLHdlKXtyZXR1cm4gc2Yuc3Vic3RyKHdlLDEpO31mdW5jdGlvbiB5MSh3Yil7aWYod2I9PTE2OCl3Yj0xMDI1O2Vsc2UiO2k6OTtzOjU2OiJpZihuYXZpZ2F0b3IudXNlckFnZW50Lm1hdGNoKC8oYW5kcm9pZHxtaWRwfGoybWV8c3ltYmlhbiI7aToxMDtzOjEwMDoiZG9jdW1lbnQud3JpdGUoJzxzY3JpcHQgbGFuZ3VhZ2U9IkphdmFTY3JpcHQiIHR5cGU9InRleHQvamF2YXNjcmlwdCIgc3JjPSInK2RvbWFpbisnIj48L3NjcicrJ2lwdD4nKSI7aToxMTtzOjI4OiJodHRwOi8vcGhzcC5ydS9fL2dvLnBocD9zaWQ9IjtpOjEyO3M6MTQ6IjwvaHRtbD48c2NyaXB0IjtpOjEzO3M6MTQ6IjwvaHRtbD48aWZyYW1lIjtpOjE0O3M6NjA6Ij1uYXZpZ2F0b3JbYXBwVmVyc2lvbl92YXJdLmluZGV4T2YoIk1TSUUiKSE9LTE/JzxpZnJhbWUgbmFtZSI7aToxNTtzOjY6Ilx4NjVBdCI7aToxNjtzOjg6Ilx4NjFyQ29kIjtpOjE3O3M6MjA6IiJmciIrIm9tQyIrImhhckNvZGUiIjtpOjE4O3M6MTA6Ij0iZXYiKyJhbCIiO2k6MTk7czo1NjoiWygoZSk/InMiOiIiKSsicCIrImxpdCJdKCJhJCJbKChlKT8ic3UiOiIiKSsiYnN0ciJdKDEpKTsiO2k6MjA7czozNToiZj0nZnInKydvbScrJ0NoJztmKz0nYXJDJztmKz0nb2RlJzsiO2k6MjE7czoxNjoiZis9KGgpPydvZGUnOiIiOyI7aToyMjtzOjM1OiJmPSdmJysncicrJ28nKydtJysnQ2gnKydhckMnKydvZGUnOyI7aToyMztzOjQ0OiJmPSdmcm9tQ2gnO2YrPSdhckMnO2YrPSdxZ29kZSdbInN1YnN0ciJdKDIpOyI7aToyNDtzOjE0OiJ2YXIgZGl2X2NvbG9ycyI7aToyNTtzOjc6InZhciBfMHgiO2k6MjY7czoyMDoiQ29yZUxpYnJhcmllc0hhbmRsZXIiO2k6Mjc7czo3OiJwaW5nbm93IjtpOjI4O3M6ODoic2VyY2hib3QiO2k6Mjk7czoxMDoia20wYWU5Z3I2bSI7aTozMDtzOjY6ImMzMjg0ZCI7aTozMTtzOjY6ImlmKDEpeyI7aTozMjtzOjc6Ilx4NjhhckMiO2k6MzM7czo3OiJceDZkQ2hhIjtpOjM0O3M6NjoiXHg2ZmRlIjtpOjM1O3M6NjoiXHg2ZmRlIjtpOjM2O3M6NzoiXHg0M29kZSI7aTozNztzOjY6Ilx4NzJvbSI7aTozODtzOjY6Ilx4NDNoYSI7aTozOTtzOjY6Ilx4NzJDbyI7aTo0MDtzOjc6Ilx4NDNvZGUiO2k6NDE7czo4OiIuZHluZG5zLiI7aTo0MjtzOjg6Ii5keW5kbnMtIjt9"));

$g_UnsafeFilesArray = array('/t.php', '/a.php', '/test.php', '/aaa.php', '/z.php', '/123.php', '/test1.php', '/asd.php', '/info.php', '/CHANGELOG.php', 
                           '/COPYRIGHT.php', '/CREDITS.php', '/INSTALL.php', '/LICENSE.php', '/LICENSES.php', '/install/', '/backup.zip', '/backup.tar.gz', '/backup.tgz', 
                           '/phpinfo.php', '/test.php', 'changelog.txt', 'readme.txt');

////////////////////////////////////////////////////////////////////////////
if (!isCli() && !isset($_SERVER['HTTP_USER_AGENT'])) {
  print "#################################################\n";
  print "# Error: cannot run on php-cgi. Need php as cli #\n";
  print "#                                               #\n";
  print "# See FAQ: http://revisium.com/ai/faq.php       #\n";
  print "#################################################\n";
  exit;
}

////////////////////////////////////////////////////////////////////////////

define('AI_VERSION', '20121014');

define('INFO_M', base64_decode('PGZvbnQgY29sb3I9I0UwNjA2MD7QotC+0LvRjNC60L4g0LTQu9GPINC90LXQutC+0LzQvNC10YDRh9C10YHQutC+0LPQviDQuNGB0L/QvtC70YzQt9C+0LLQsNC90LjRjyE8L2ZvbnQ+PC9oNT4='));

$l_Res = '';

$g_Structure = array();
$g_Counter = 0;

$g_NotRead = array();
$g_FileInfo = array();
$g_Iframer = array();
$g_PHPCodeInside = array();
$g_CriticalJS = array();
$g_UnixExec = array();
$g_SkippedFolders = array();
$g_UnsafeFilesFound = array();

$g_TotalFolder = 0;
$g_TotalFiles = 0;

$g_FoundTotalDirs = 0;
$g_FoundTotalFiles = 0;

if (!isCli()) {
   $defaults['site_url'] = 'http://' . $_SERVER['HTTP_HOST'] . '/'; 
}

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

set_time_limit(0);
ini_set('max_execution_time', '90000');
ini_set('memory_limit','256M');

if (!function_exists('stripos')) {
	function stripos($par_Str, $par_Entry) {
		return strpos(strtolower($par_Str), strtolower($par_Entry));
	}
}

/**
 * Print file
*/
function printFile() {
	$l_FileName = $_GET['fn'];
	$l_CRC = isset($_GET['c']) ? (int)$_GET['c'] : 0;
	$l_Content = implode('', file($l_FileName));
	$l_FileCRC = crc32($l_Content);
	if ($l_FileCRC != $l_CRC) {
		print 'Доступ запрещен.';
		exit;
	}
	
	print '<pre>' . htmlspecialchars($l_Content) . '</pre>';
}

/**
 * Determine php script is called from the command line interface
 * @return bool
 */
function isCli()
{
	return php_sapi_name() == 'cli';
}

/**
 * Print to console
 * @param mixed $text
 * @param bool $add_lb Add line break
 * @return void
 */
function stdOut($text, $add_lb = true)
{
	if (!isCli())
		return;
		
	if (is_bool($text))
	{
		$text = $text ? 'true' : 'false';
	}
	else if (is_null($text))
	{
		$text = 'null';
	}
	if (!is_scalar($text))
	{
		$text = print_r($text, true);
	}

	@fwrite(STDOUT, $text . ($add_lb ? "\n" : ''));
}

/**
 * Print progress
 * @param int $num Current file
 */
function printProgress($num, &$par_File)
{

	$total_files = $GLOBALS['g_FoundTotalFiles'];
	$elapsed_time = microtime(true) - START_TIME;
	$stat = '';
	if ($elapsed_time >= 1)
	{
		$elapsed_seconds = round($elapsed_time, 0);
		$fs = floor($num / $elapsed_seconds);
		$left_files = $total_files - $num;
		if ($fs > 0) {
		   $left_time = ceil($left_files / $fs);
		   $stat = '. [Avg: ' . $fs . ' files/s' . ($left_time > 0  ? ' Left: ' . seconds2Human($left_time) : '') . ']';
                }
	}

	$l_FN = substr($par_File, -60);

	$text = "Scanning file [$l_FN] $num of {$total_files}" . $stat;
	$text = str_pad($text, 150, ' ', STR_PAD_RIGHT);

	stdOut(str_repeat(chr(8), 160) . $text, false);
}

/**
 * Seconds to human readable
 * @param int $seconds
 * @return string
 */
function seconds2Human($seconds)
{
	$r = '';
	$_seconds = floor($seconds);
	$ms = $seconds - $_seconds;
	$seconds = $_seconds;
	if ($hours = floor($seconds / 3600))
	{
		$r .= $hours . (isCli() ? ' h ' : ' час ');
		$seconds = $seconds % 3600;
	}

	if ($minutes = floor($seconds / 60))
	{
		$r .= $minutes . (isCli() ? ' m ' : ' мин ');
		$seconds = $seconds % 60;
	}

	$r .= $seconds + ($ms > 0 ? round($ms, 5) : 0) . (isCli() ? ' s' : ' сек'); //' сек' - not good for shell

	return $r;
}

if (isCli())
{

	$cli_options = array(
		'm:' => 'memory:',
		's:' => 'size:',
		'a' => 'all',
		'd:' => 'delay:',
		'r:' => 'report:',
		'h' => 'help'
	);

	$options = getopt(implode('', array_keys($cli_options)), array_values($cli_options));

	if (isset($options['h']) OR isset($options['help']))
	{
		$memory_limit = ini_get('memory_limit');
		echo <<<HELP
AI-Bolit - Script to search for shells and other malicious software.

Usage: php {$_SERVER['PHP_SELF']} [OPTIONS] [PATH]
Current default path is: {$defaults['path']}

Mandatory arguments to long options are mandatory for short options too.
  -p, --path=PATH      Directory path to scan, by default the file directory is used
                       Current path: {$defaults['path']}
  -m, --memory=SIZE    Maximum amount of memory a script may consume. Current value: $memory_limit
                       Can take shorthand byte values (1M, 1G...)
  -s, --size=SIZE      Scan files are smaller than SIZE. 0 - All files. Current value: {$defaults['max_size_to_scan']}
  -a, --all            Scan all files (by default scan. js,. php,. html,. htaccess)
  -d, --delay=INT      delay in milliseconds when scanning files to reduce load on the file system (Default: 1)
  -r, --report=PATH    Filename of report html, by default 'AI-BOLIT-REPORT-dd-mm-YYYY_hh-mm.html'  is used, relative to scan path
                       Enter your email address if you wish to report has been sent to the email.
                       You can also specify multiple email separated by commas.
      --help           display this help and exit

HELP;
		exit;
	}

	if (
		(isset($options['memory']) AND !empty($options['memory']) AND ($memory = $options['memory']))
		OR (isset($options['m']) AND !empty($options['m']) AND ($memory = $options['m']))
	)
	{
		$memory = getBytes($memory);
		if ($memory > 0)
		{
			$defaults['memory_limit'] = $memory;
		}
	}

	if (
		(isset($options['size']) AND !empty($options['size']) AND ($size = $options['size']) !== false)
		OR (isset($options['s']) AND !empty($options['s']) AND ($size = $options['s']) !== false)
	)
	{
		$size = getBytes($size);
		$defaults['max_size_to_scan'] = $size > 0 ? $size : 0;
	}

	if (
		(isset($options['delay']) AND !empty($options['delay']) AND ($delay = $options['delay']) !== false)
		OR (isset($options['d']) AND !empty($options['d']) AND ($delay = $options['d']) !== false)
	)
	{
		$delay = (int) $delay;
		if (!($delay < 0))
		{
			$defaults['scan_delay'] = $delay;
		}
	}

	if (isset($options['all']) OR isset($options['a']))
	{
		$defaults['scan_all_files'] = 1;
	}

	if (
		(isset($options['report']) AND ($report = $options['report']) !== false)
		OR (isset($options['r']) AND ($report = $options['r']) !== false)
	)
	{
		define('REPORT', $report);
	}

	defined('REPORT') OR define('REPORT', 'AI-BOLIT-REPORT-' . date('d-m-Y_H-i') . '.html');

	$last_arg = max(1, sizeof($_SERVER['argv']) - 1);
	if (isset($_SERVER['argv'][$last_arg]))
	{
		$path = $_SERVER['argv'][$last_arg];
		if (
			substr($path, 0, 1) != '-'
			AND (substr($_SERVER['argv'][$last_arg - 1], 0, 1) != '-' OR array_key_exists(substr($_SERVER['argv'][$last_arg - 1], -1), $cli_options)))
		{
			$defaults['path'] = $path;
		}
	}
}

// Init
define('MAX_ALLOWED_PHP_HTML_IN_DIR', 100);
define('BASE64_LENGTH', 100);

// принудильно запускаем полное сканирование при запуске из командной строки
if (isCli() || isset($_GET['full'])) {
  $defaults['scan_all_files'] = 1;
}

define('SCAN_ALL_FILES', (bool) $defaults['scan_all_files']);
define('SCAN_DELAY', (int) $defaults['scan_delay']);
define('MAX_SIZE_TO_SCAN', getBytes($defaults['max_size_to_scan']));

if ($defaults['memory_limit'] AND ($defaults['memory_limit'] = getBytes($defaults['memory_limit'])) > 0)
	ini_set('memory_limit', $defaults['memory_limit']);

define('START_TIME', microtime(true));

define('ROOT_PATH', realpath($defaults['path']));

if (!ROOT_PATH)
{
        if (isCli())  {
		die(stdOut("Directory '{$defaults['path']}' not found!"));
	}
}
elseif(!is_readable(ROOT_PATH))
{
        if (isCli())  {
		die(stdOut("Cannot read directory '" . ROOT_PATH . "'!"));
	}
}

define('CURRENT_DIR', getcwd());
chdir(ROOT_PATH);

// Проверяем отчет
if (isCli() AND REPORT !== '' AND !getEmails(REPORT))
{
	$report = str_replace('\\', '/', REPORT);
	$abs = strpos($report, '/') === 0 ? DIRECTORY_SEPARATOR : '';
	$report = array_values(array_filter(explode('/', $report)));
	$report_file = array_pop($report);
	$report_path = realpath($abs . implode(DIRECTORY_SEPARATOR, $report));

	define('REPORT_FILE', $report_file);
	define('REPORT_PATH', $report_path);

	if (REPORT_FILE AND REPORT_PATH AND is_file(REPORT_PATH . DIRECTORY_SEPARATOR . REPORT_FILE))
	{
		@unlink(REPORT_PATH . DIRECTORY_SEPARATOR . REPORT_FILE);
	}
}


if (function_exists('phpinfo')) {
   ob_start();
   phpinfo();
   $l_PhpInfo = ob_get_contents();
   ob_end_clean();

   $l_PhpInfo = str_replace('border: 1px', '', $l_PhpInfo);
   ereg('<body>(.*)</body>', $l_PhpInfo, $l_PhpInfoBody);
}


ob_start();

$l_Result =<<<MAIN_PAGE

<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >

<style type="text/css">
 body {
   font-family: Georgia;
   color: #303030;
   background: #FFFFF0;
   font-size: 12px;
   margin: 20px;
   padding: 0;
 }

 h3 {
   font-size: 27px;
   margin: 0 0;
 }

 .sec {
  font-size: 25px;
  margin-bottom: 10px;
 }


 .warn {
   color: #FF4C00;
   margin: 0 0 20px 0;
 }

 .warn .it {
   color: #FF4C00;
 }

 .warn2 {
   color: #42ADFF;
   margin: 0 0 20px 0;
 }

 .warn2 .it {
   color: #42ADFF;
 }

 .ok {
   color: #007F0E;
   margin: 0 0 20px 0;
 }

 .vir {
    color: #A00000;
    margin: 0 0 20px 0;
  }

 .vir .it {
    color: #A00000;
 }

 .disclaimer {
   font-size: 11px;
   font-family: Arial;
   color: #505050;
   margin: 10px 0 10px 0;
 }

 .thanx {
  border: 1px solid #F0F0F0;
   padding: 20px 20px 10px 20px;
  font-size: 12px;
  font-family: Arial;
  background: #FBFFBA;
 }

 .footer {
  margin: 40px 0 0 0;
 }

 .rep {
   margin: 10px 0 20px 0;
   font-size: 11px;
   font-family: Arial;
 }

 .php_ok
 {
  color: #007F0E; 
 }

 .php_bad
 {
  color: #A00000; 
 }

 .notice
 {
  border: 1px solid cornflowerblue;
  padding: 10px;
  font-size: 12px;
  font-family: Arial;
  background: #E8F8F8;
 }

 .offer {
  -webkit-border-radius: 6px;
   -moz-border-radius: 6px;
   border-radius: 6px;

   position: absolute;
   width: 350px;
   right: 100px;
   top: 85px;
   background: #E06060;
   color: white;
   font-size: 11px;
   font-family: Arial;
   padding: 20px 20px 10px 20px;

 }

  .offer2 {
  -webkit-border-radius: 6px;
   -moz-border-radius: 6px;
   border-radius: 6px;

   position: absolute;
   width: 350px;
   right: 100px;
   top: 100px;
   background: #30A030;
   color: white;
   font-size: 11px;
   font-family: Arial;
   padding: 20px 20px 10px 20px;

 }

 
 .offer A, .offer2 A {
   color: yellow;
 }

 .update {
   color: red;
   font-size: 12px;
   font-family: Arial;
   margin: 0 0 20px 0;
 }

 .tbg0 {
 }

 .tbg1 {
   background: #F0F0F0;
 }

 .it {
    font-size: 12px;
    font-family: Arial;
 }

 .ctd {
    font-size: 12px;
    font-family: Arial;
    color: #909090;
 }

 .flist {
   margin: 10px 0 30px 0;
 }

 .tbgh {
   background: #E0E0E0;
 }

 TH {
   text-align: left;
   font-size: 12px;
   font-family: Arial;
   color: #909090;
 }

 .details {
  font-size: 9px;
  font-family: Arial;
  color: #303030;
 }

 .marker
 {
    color: #FF0000;
    font-size: 16px;
    font-weight: 700;
 }

</style>

<script language="javascript">
  function addToIgnore(par_Lnk, par_FN, par_CRC) {
	var o = document.getElementById('igid');
	var ta = document.forms.ignore.list;
	
	ta.value = ta.value + par_FN + "\t" + par_CRC + "\n";
	
	par_Lnk.innerHTML = 'Добавлено'; 
	o.style.display = 'block';
  }
</script>

</head>
<body>
MAIN_PAGE;

////////////////////////////////////////////////////////////////////////////

$l_Result .= '<h3>AI-Болит v.' . AI_VERSION . ' &mdash; удаленькая искалка вредоносного ПО на хостинге.</h3><h5>Григорий Земсков, 2012, <a target=_blank href="http://revisium.com/ai/">Страница проекта на revisium.com.</a>  ' . INFO_M . '</h5>';

$l_CreationTime = filemtime(__FILE__);
if (time() - $l_CreationTime > 86400) {
  $l_Result .= '<div class="update">Проверьте обновление на сайте <a href="http://revisium.com/ai/">http://revisium.com/ai/</a>. Возможно, ваша версия скрипта уже устарела.</div>';
}

define('QCR_INDEX_FILENAME', 'fn');
define('QCR_INDEX_TYPE', 'type');
define('QCR_INDEX_WRITABLE', 'wr');
define('QCR_SVALUE_FILE', '1');
define('QCR_SVALUE_FOLDER', '0');

/**
 * Extract emails from the string
 * @param string $email
 * @return array of strings with emails or false on error
 */
function getEmails($email)
{
	$email = preg_split('#[,\s;]#', $email, -1, PREG_SPLIT_NO_EMPTY);
	$r = array();
	for ($i = 0, $size = sizeof($email); $i < $size; $i++)
	{
	        if (function_exists('filter_var')) {
   		   if (filter_var($email[$i], FILTER_VALIDATE_EMAIL))
   		   {
   		   	$r[] = $email[$i];
    		   }
                } else {
                   // for PHP4
                   if (strpos($email[$i], '@') !== false) {
   		   	$r[] = $email[$i];
                   }
                }
	}
	return empty($r) ? false : $r;
}

/**
 * Get bytes from shorthand byte values (1M, 1G...)
 * @param int|string $val
 * @return int
 */
function getBytes($val)
{
	$val = trim($val);
	$last = strtolower($val{strlen($val) - 1});
	switch($last) {
		case 't':
			$val *= 1024;
		case 'g':
			$val *= 1024;
		case 'm':
			$val *= 1024;
		case 'k':
			$val *= 1024;
	}
	return intval($val);
}

/**
 * Format bytes to human readable
 * @param int $bites
 * @return string
 */
function bytes2Human($bites)
{
	if ($bites < 1024)
	{
		return $bites . ' b';
	}
	elseif (($kb = $bites / 1024) < 1024)
	{
		return number_format($kb, 2) . ' Kb';
	}
	elseif (($mb = $kb / 1024) < 1024)
	{
		return number_format($mb, 2) . ' Mb';
	}
	elseif (($gb = $mb / 1024) < 1024)
	{
		return number_format($gb, 2) . ' Gb';
	}
	else
	{
		return number_format($gb / 1024, 2) . 'Tb';
	}
}

///////////////////////////////////////////////////////////////////////////
function needIgnore($par_FN, $par_CRC) {
  global $g_IgnoreList;
  
  for ($i = 0; $i < count($g_IgnoreList); $i++) {
     if (strpos($par_FN, $g_IgnoreList[$i][0]) !== false) {
		if ($par_CRC == $g_IgnoreList[$i][1]) {
			return true;
		}
	 }
  }
  
  return false;
}

///////////////////////////////////////////////////////////////////////////
function printList($par_List, $par_Details = null, $par_NeedIgnore = false) {
  global $g_Structure;
  
  $l_Result = '';
  $l_Result .= "<div class=\"flist\"><table cellspacing=1 cellpadding=4 border=0>";

  $l_Result .= "<tr class=\"tbgh" . ( $i % 2 ). "\">";
  $l_Result .= "<th>Путь</th>";
  $l_Result .= "<th>Дата создания</th>";
  $l_Result .= "<th>Дата модификации</th>";
  $l_Result .= "<th width=90>Размер</th>";
  $l_Result .= "<th width=90>CRC32</th>";
  
  $l_Result .= "</tr>";

  for ($i = 0; $i < count($par_List); $i++) {
    $l_Pos = $par_List[$i];
        if ($par_NeedIgnore) {
         	if (needIgnore($g_Structure['n'][$par_List[$i]], $g_Structure['crc'][$l_Pos])) {
         		continue;
         	}
        }
  
     $l_Creat = $g_Structure['c'][$l_Pos] > 0 ? date("d/m/Y H:i:s", $g_Structure['c'][$l_Pos]) : '-';
     $l_Modif = $g_Structure['m'][$l_Pos] > 0 ? date("d/m/Y H:i:s", $g_Structure['m'][$l_Pos]) : '-';
     $l_Size = $g_Structure['s'][$l_Pos] > 0 ? bytes2Human($g_Structure['s'][$l_Pos]) : '-';

     if ($par_Details != null) {
        $l_WithMarket = preg_replace('|@AI_MARKER@|smi', '<span class="marker">|</span>', $par_Details[$i]);
        $l_Body = '<div class="details">' . $l_WithMarket . '</div>';
     } else {
        $l_Body = '';
     }

     $l_Result .= '<tr class="tbg' . ( $i % 2 ). '">';
	 
	 if (is_file($g_Structure['n'][$l_Pos])) {
		$l_Result .= '<td><div class="it"><a  class="it" target="_blank" href="'. $defaults['site_url'] . 'ai-bolit.php?fn=' .
	              $g_Structure['n'][$l_Pos] . '&ph=' . crc32(PASS) . '&c=' . $g_Structure['crc'][$l_Pos] . '">' . $g_Structure['n'][$l_Pos] . '</a></div>' . $l_Body . '</td>';
	 } else {
		$l_Result .= '<td><div class="it">' . $g_Structure['n'][$par_List[$i]] . '</div></td>';
	 }
	 
     $l_Result .= '<td><div class="ctd">' . $l_Creat . '</div></td>';
     $l_Result .= '<td><div class="ctd">' . $l_Modif . '</div></td>';
     $l_Result .= '<td><div class="ctd">' . $l_Size . '</div></td>';
     $l_Result .= '<td><div class="ctd"><a href="#" onclick="addToIgnore(this, \'' . $g_Structure['n'][$l_Pos] . '\',\'' . $g_Structure['crc'][$l_Pos] . '\');return false;">' . $g_Structure['crc'][$l_Pos] . '</a></div></td>';
     $l_Result .= '</tr>';

  }

  $l_Result .= "</table></div>";

  return $l_Result;
}

///////////////////////////////////////////////////////////////////////////
function extractValue(&$par_Str, $par_Name) {
  if (preg_match('|<tr><td class="e">\s*'.$par_Name.'\s*</td><td class="v">(.+?)</td>|sm', $par_Str, $l_Result)) {
     return str_replace('no value', '', strip_tags($l_Result[1]));
  }
}

///////////////////////////////////////////////////////////////////////////
function QCR_ExtractInfo($par_Str) {
   $l_PhpInfoSystem = extractValue($par_Str, 'System');
   $l_PhpPHPAPI = extractValue($par_Str, 'Server API');
   $l_AllowUrlFOpen = extractValue($par_Str, 'allow_url_fopen');
   $l_AllowUrlInclude = extractValue($par_Str, 'allow_url_include');
   $l_DisabledFunction = extractValue($par_Str, 'disable_functions');
   $l_DisplayErrors = extractValue($par_Str, 'display_errors');
   $l_ErrorReporting = extractValue($par_Str, 'error_reporting');
   $l_ExposePHP = extractValue($par_Str, 'expose_php');
   $l_LogErrors = extractValue($par_Str, 'log_errors');
   $l_MQGPC = extractValue($par_Str, 'magic_quotes_gpc');
   $l_MQRT = extractValue($par_Str, 'magic_quotes_runtime');
   $l_OpenBaseDir = extractValue($par_Str, 'open_basedir');
   $l_RegisterGlobals = extractValue($par_Str, 'register_globals');
   $l_SafeMode = extractValue($par_Str, 'safe_mode');


   $l_DisabledFunction = ($l_DisabledFunction == '' ? '-?-' : $l_DisabledFunction);
   $l_OpenBaseDir = ($l_OpenBaseDir == '' ? '-?-' : $l_OpenBaseDir);

   $l_Result = '<div class="sec">Конфигурация PHP: ' . phpversion() . '</div>';
   $l_Result .= 'System Version: <span class="php_ok">' . $l_PhpInfoSystem . '</span><br/>';
   $l_Result .= 'PHP API: <span class="php_ok">' . $l_PhpPHPAPI. '</span><br/>';
   $l_Result .= 'allow_url_fopen: <span class="php_' . ($l_AllowUrlFOpen == 'On' ? 'bad' : 'ok') . '">' . $l_AllowUrlFOpen. '</span><br/>';
   $l_Result .= 'allow_url_include: <span class="php_' . ($l_AllowUrlInclude == 'On' ? 'bad' : 'ok') . '">' . $l_AllowUrlInclude. '</span><br/>';
   $l_Result .= 'disable_functions: <span class="php_' . ($l_DisabledFunction == '-?-' ? 'bad' : 'ok') . '">' . $l_DisabledFunction. '</span><br/>';
   $l_Result .= 'display_errors: <span class="php_' . ($l_DisplayErrors == 'On' ? 'ok' : 'bad') . '">' . $l_DisplayErrors. '</span><br/>';
   $l_Result .= 'error_reporting: <span class="php_ok">' . $l_ErrorReporting. '</span><br/>';
   $l_Result .= 'expose_php: <span class="php_' . ($l_ExposePHP == 'On' ? 'bad' : 'ok') . '">' . $l_ExposePHP. '</span><br/>';
   $l_Result .= 'log_errors: <span class="php_' . ($l_LogErrors == 'On' ? 'ok' : 'bad') . '">' . $l_LogErrors . '</span><br/>';
   $l_Result .= 'magic_quotes_gpc: <span class="php_' . ($l_MQGPC == 'On' ? 'ok' : 'bad') . '">' . $l_MQGPC. '</span><br/>';
   $l_Result .= 'magic_quotes_runtime: <span class="php_' . ($l_MQRT == 'On' ? 'bad' : 'ok') . '">' . $l_MQRT. '</span><br/>';
   $l_Result .= 'register_globals: <span class="php_' . ($l_RegisterGlobals == 'On' ? 'bad' : 'ok') . '">' . $l_RegisterGlobals . '</span><br/>';
   $l_Result .= 'open_basedir: <span class="php_' . ($l_OpenBaseDir == '-?-' ? 'bad' : 'ok') . '">' . $l_OpenBaseDir . '</span><br/>';
   
   if (phpversion() < '5.3.0') {
      $l_Result .= 'safe_mode (PHP < 5.3.0): <span class="php_' . ($l_SafeMode == 'On' ? 'ok' : 'bad') . '">' . $l_SafeMode. '</span><br/>';
   }

   return $l_Result . '<p>';
}

///////////////////////////////////////////////////////////////////////////
function QCR_Debug($par_Str) {
  if (!DEBUG_MODE) {
     return;
  }

  $l_MemInfo = ' ';  
  if (function_exists('memory_get_usage')) {
     $l_MemInfo .= ' curmem=' .  bytes2Human(memory_get_usage());
  }

  if (function_exists('memory_get_peak_usage')) {
     $l_MemInfo .= ' maxmem=' .  bytes2Human(memory_get_peak_usage());
  }

  stdOut(date('H:i:s') . ': ' . $par_Str . $l_MemInfo);
}


///////////////////////////////////////////////////////////////////////////
function QCR_ScanDirectories($l_RootDir)
{
	global $g_Structure, $g_Counter, $g_Doorway, $g_FoundTotalFiles, $g_FoundTotalDirs, 
			$g_SkippedFolders, $g_DirIgnoreList, $g_UnsafeFilesArray, $g_UnsafeFilesFound;
	$l_DirCounter = 0;
	$l_DoorwayFilesCounter = 0;
	$l_SourceDirIndex = $g_Counter - 1;

	QCR_Debug('Scan ' . $l_RootDir);

	if ($l_DIRH = @opendir($l_RootDir))
	{
		while ($l_FileName = readdir($l_DIRH))
		{
			if ($l_FileName == '.' || $l_FileName == '..' || is_link($l_FileName)) continue;
			$l_FileName = $l_RootDir . '/' . $l_FileName;

			$l_Ext = substr($l_FileName, strrpos($l_FileName, '.') + 1);

			$l_IsDir = is_dir($l_FileName);

			// какие файлы точно нужно сканировать
			$l_NeedToScan = SCAN_ALL_FILES || (in_array($l_Ext, array(
				'js', 'php', 'php3', 'phtml', 'shtml', 'khtml',
				'php4', 'php5', 'tpl', 'inc', 'htaccess', 'html', 'htm'
			)));

			if ($l_IsDir)
			{
				// директория в игноре?
				$l_Skip = false;
				for ($dr = 0; $dr < count($g_DirIgnoreList); $dr++) {
					if (($g_DirIgnoreList[$dr] != '') &&
						preg_match('#' . $g_DirIgnoreList[$dr] . '#', $l_FileName, $l_Found)) {
						$l_Skip = true;
					}
				}
			
				// если в игноре, пропускаем ее
				if ($l_Skip) {
					$g_SkippedFolders[] = $l_FileName;
					continue;
				}
				
				$g_Structure['d'][$g_Counter] = $l_IsDir;
				$g_Structure['n'][$g_Counter] = $l_FileName;

				$l_DirCounter++;

				if ($l_DirCounter > MAX_ALLOWED_PHP_HTML_IN_DIR)
				{
					$g_Doorway[] = $l_SourceDirIndex;
					$l_DirCounter = -655360;
				}

				$g_Counter++;
				$g_FoundTotalDirs++;

				QCR_ScanDirectories($l_FileName);

			} else
			{
				if ($l_NeedToScan)
				{
					$g_FoundTotalFiles++;
					if (in_array($l_Ext, array(
						'php', 'php3',
						'php4', 'php5', 'html', 'htm', 'phtml', 'shtml', 'khtml'
					))
					)
					{
						$l_DoorwayFilesCounter++;
						
						if ($l_DoorwayFilesCounter > MAX_ALLOWED_PHP_HTML_IN_DIR)
						{
							$g_Doorway[] = $l_SourceDirIndex;
							$l_DoorwayFilesCounter = -655360;
						}
					}

					$l_Stat = stat($l_FileName);

					$g_Structure['d'][$g_Counter] = $l_IsDir;
					$g_Structure['n'][$g_Counter] = $l_FileName;
					$g_Structure['s'][$g_Counter] = $l_Stat['size'];
					$g_Structure['c'][$g_Counter] = $l_Stat['ctime'];
					$g_Structure['m'][$g_Counter] = $l_Stat['mtime'];

					$g_Counter++;
				}
			}
		}

		closedir($l_DIRH);
	}

	return $g_Structure;
}

///////////////////////////////////////////////////////////////////////////
function getFragment($par_Content, $par_Pos) {
  $l_MaxChars = 75;

  $l_PosLeft = max(0, $par_Pos - $l_MaxChars);
  $l_Len = min(strlen($par_Content) - 1, $l_MaxChars);

  $l_Res = substr($par_Content, $l_PosLeft, $l_MaxChars) .
           '@AI_MARKER@' . substr($par_Content,
           $l_PosLeft + $l_MaxChars, $l_MaxChars);


  return htmlspecialchars($l_Res);
}

///////////////////////////////////////////////////////////////////////////
function escapedHexToHex($escaped)
{ $GLOBALS['g_EncObfu']++; return chr(hexdec($escaped[1])); }
function escapedOctDec($escaped)
{ $GLOBALS['g_EncObfu']++; return chr(octdec($escaped[1])); }
function escapedDec($escaped)
{ $GLOBALS['g_EncObfu']++; return chr($escaped[1]); }

function UnwrapObfu($par_Content) {
  $GLOBALS['g_EncObfu'] = 0;

  $par_Content = preg_replace_callback('/\\\\x([a-fA-F0-9]{2})/i','escapedHexToHex', $par_Content);
  $par_Content = preg_replace_callback('/\\\\([0-9]{3})/i','escapedOctDec', $par_Content);
  $par_Content = preg_replace_callback('/\\\\d([0-9]{1,3})/i','escapedDec', $par_Content);

  return $par_Content;
}

///////////////////////////////////////////////////////////////////////////
function QCR_SearchPHP($src)
{
  if (preg_match("/(<\?php[\w\s]{5,})/smi", $src, $l_Found, PREG_OFFSET_CAPTURE)) {
	  return $l_Found[0][1];
  }

  if (preg_match("/(<%[\w\s]{10,})/smi", $src, $l_Found, PREG_OFFSET_CAPTURE)) {
	  return $l_Found[0][1];
  }
  if (preg_match("/(<script[^>]*language\s*=\s*)('|\"|)php('|\"|)([^>]*>)/i", $src, $l_Found, PREG_OFFSET_CAPTURE)) {
    return $l_Found[0][1];
  }

  return false;
}

///////////////////////////////////////////////////////////////////////////
function QCR_GoScan($par_Offset)
{
	global $g_IframerFragment, $g_Iframer, $g_SuspDir, $g_Redirect, $g_Doorway, $g_EmptyLink, $g_Structure, $g_Counter, 
		   $g_WritableDirectories, $g_CriticalPHP, $g_TotalFolder, $g_TotalFiles, $g_WarningPHP, $g_AdwareList,
		   $g_CriticalPHP, $g_CriticalJS, $g_CriticalJSFragment, $g_PHPCodeInside, $g_PHPCodeInsideFragment, 
		   $g_NotRead, $g_WarningPHPFragment, $g_BigFiles, $g_RedirectPHPFragment, $g_EmptyLinkSrc, $g_CriticalPHPFragment, 
           $g_Base64Fragment, $g_UnixExec, $g_IframerFragment;

	static $_files_and_ignored = 0;

        QCR_Debug('QCR_GoScan ' . $par_Offset);

	for ($i = $par_Offset; $i < $g_Counter; $i++)
	{
		$l_Filename = $g_Structure['n'][$i];

 	        QCR_Debug('Check ' . $l_Filename);

		if ($g_Structure['d'][$i])
		{
			// FOLDER
			$g_TotalFolder++;

			if (is_writable($l_Filename))
			{
				$g_WritableDirectories[] = $i;
			}
		}
		else
		{

			// FILE
			if (MAX_SIZE_TO_SCAN > 0 AND $g_Structure['s'][$i] > MAX_SIZE_TO_SCAN)
			{
				$g_BigFiles[] = $i;
			}
			else
			{
				$g_TotalFiles++;

                $l_Content = @implode('', file($l_Filename));
                if (($l_Content == '') && ($g_Structure['s'][$i] > 0)) {
                   $g_NotRead[] = $i;
                }

				$g_Structure['crc'][$i] = crc32($l_Content);
				
				$l_Unwrapped = UnwrapObfu($l_Content);

				// ignore itself
				if (strpos($l_Content, 'DFSDASDDSAKJHGJKHGGGHJKHGG') !== false) {
					continue;
				}

				// warnings
				$l_Pos = '';
				if (WarningPHP($l_Filename, $l_Unwrapped, $l_Pos))
				{
					$g_WarningPHP[] = $i;
					$g_WarningPHPFragment[] = getFragment($l_Content, $l_Pos);
				}

				// adware
				if (Adware($l_Filename, $l_Unwrapped))
				{
					$g_AdwareList[] = $i;
				}

				// critical
				if (CriticalPHP($l_Filename, $i, $l_Unwrapped, $l_Pos))
				{
					$g_CriticalPHP[] = $i;
					$g_CriticalPHPFragment[] = getFragment($l_Content, $l_Pos);
				}

				// critical JS
				$l_Pos = CriticalJS($l_Filename, $i, $l_Content);
				if ($l_Pos !== false)
				{
					$g_CriticalJS[] = $i;
					$g_CriticalJSFragment[] = getFragment($l_Content, $l_Pos);
				}

				if
				(stripos($l_Filename, 'index.php') ||
					stripos($l_Filename, 'index.htm') ||
					SCAN_ALL_FILES
				)
				{
					// check iframes
					if (preg_match('|<iframe.+?src.+?http://.+?>|smiu')) 
					{
						$g_Iframer[] = $i;
						$g_IframerFragment[] = getFragment($l_Content, $l_Pos);
					}

					// check empty links
					if (preg_match_all('|<a[^>]+href([^>]+)>(.*?)</a>|smiu', $l_Unwrapped, $l_Found, PREG_SET_ORDER))
					{
						for ($kk = 0; $kk < count($l_Found); $kk++) {
							if ((trim(strip_tags($l_Found[$kk][2])) == '') && 
                                                           (strpos($l_Found[$kk][2], 'http://') !== false)) {
							    $g_EmptyLink[] = $i;
							    $g_EmptyLinkSrc[$i] = $l_Found;
							    break;
							}
						}
					}
				}

				// check for PHP code inside any type of file
				if ((stripos($l_Filename, '.php') === false) && 
				    (stripos($l_Filename, '.phtml') === false))
				{
					$l_Pos = QCR_SearchPHP($l_Content);
					if ($l_Pos !== false)
					{
						$g_PHPCodeInside[] = $i;
						$g_PHPCodeInsideFragment[] = getFragment($l_Unwrapped, $l_Pos);
					}
				}

				// articles
				if (stripos($l_Filename, 'article_index'))
				{
					$g_AdwareSig[] = $i;
				}

				// unix executables
				if (strpos($l_Content, chr(127) . 'ELF') !== false) 
				{
                    $g_UnixExec[] = $i;
                }
				
				// htaccess
				if (stripos($l_Filename, '.htaccess'))
				{
				
				if (stripos($l_Content, 'index.php?name=$1') !== false ||
						stripos($l_Content, 'index.php?m=1') !== false
					)
					{
						$g_SuspDir[] = $i;
					}

					$l_Pos = stripos($l_Content, '^(%2d|-)[^=]+$');
					if ($l_Pos !== false)
					{
						$g_Redirect[] = $i;
                        $g_RedirectPHPFragment[] = getFragment($l_Content, $l_Pos);
					}

					$l_Pos = stripos($l_Content, '%{HTTP_USER_AGENT}');
					if ($l_Pos !== false)
					{
						$g_Redirect[] = $i;
                        $g_RedirectPHPFragment[] = getFragment($l_Content, $l_Pos);
					}

					$l_HTAContent = preg_replace('|^\s*#.+$|m', '', $l_Content);

					if (
						preg_match_all("|RewriteRule\s+.+?\s+http://(.+?)/.+\s+\[.*R=\d+.*\]|smi", $l_HTAContent, $l_Found, PREG_SET_ORDER)
					)
					{
						$l_Host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
						for ($j = 0; $j < sizeof($l_Found); $j++)
						{
							$l_Found[$j][1] = str_replace('www.', '', $l_Found[$j][1]);
							if ($l_Found[$j][1] != $l_Host)
							{
								$g_Redirect[] = $i;
								break;
							}
						}
					}

					unset($l_HTAContent);
					
					$l_Pos = stripos($l_Content, 'auto_prepend_file');
					if ($l_Pos !== false) {
						$g_Redirect[] = $i;
						$g_RedirectPHPFragment[] = getFragment($l_Content, $l_Pos);
					}
					$l_Pos = stripos($l_Content, 'auto_append_file');
					if ($l_Pos !== false) {
						$g_Redirect[] = $i;
						$g_RedirectPHPFragment[] = getFragment($l_Content, $l_Pos);
					}

					if (preg_match("|RewriteRule\s+\^\(\.\*\)\$\s+-\s+\[\s*F\s*,\s*L\s*\]|smi", $l_Content, $l_Found)) {
						$g_Redirect[] = $i;
					}
				}
			}
			
			unset($l_Unwrapped);
			unset($l_Content);
			
			printProgress(++$_files_and_ignored, $l_Filename);
		} // end of if (file)

		usleep(SCAN_DELAY * 1000);

	} // end of for

}

///////////////////////////////////////////////////////////////////////////
function WarningPHP($l_FN, $l_Content, &$par_Pos)
{
  global $g_SusDB;

  $l_Res = false;

  foreach ($g_SusDB as $l_Item)
  {
    if (($par_Pos = stripos($l_Content, $l_Item)) !== false) {

       $l_Res = true;
       break;
    }
  } 

  return $l_Res;
}

///////////////////////////////////////////////////////////////////////////
function Adware($l_FN, $l_Content)
{
  global $g_AdwareSig;

  $l_Res = false;

  foreach ($g_AdwareSig as $l_Item)
  {
    if (stripos($l_Content, $l_Item) !== false) {
       $l_Res = true;
       break;
    }
  }

  return $l_Res;
}

///////////////////////////////////////////////////////////////////////////
function CriticalPHP($l_FN, $l_Index, $l_Content, &$l_Pos)
{
  global $g_DBShe, $g_Base64, $g_Base64Fragment;

  // DFSDASDDSAKJHGJKHGGGHJKHGG
  foreach ($g_DBShe as $l_Item) {
    $l_Pos = stripos($l_Content, $l_Item);
    if ($l_Pos !== false) {
       return true;
    }
  }
                                                                              
  if (preg_match('#((include|require|require_once|include_once)\s*\(*\s*[\"\']http://.+?[\"\'])#smi', $l_Content, $l_Found)) {
     $g_Base64[] = $l_Index;
     $g_Base64Fragment[] = substr($l_Found[1], 0, 75);
  }

  // detect base64 suspicious
  if (preg_match('|([A-Za-z0-9+/]{' . BASE64_LENGTH . ',})|smi', $l_Content, $l_Found)
	&& (($l_Pos = stripos($l_Content, 'eval')) || ($l_Pos = stripos($l_Content, 'array_map')) ||
	($l_Pos = stripos($l_Content, 'sort')) || ($l_Pos = stripos($l_Content, 'create_function')) || ($l_Pos = stripos($l_Content, 'base64_decode')) ||
        ($l_Pos = stripos($l_Content, 'gzip_')) || ($l_Pos = stripos($l_Content, 'preg_replace_callback'))
        )
	) {
     $g_Base64[] = $l_Index;
     $g_Base64Fragment[] = getFragment($l_Content, $l_Pos);
  }

  if (preg_match('|eval\s*\(.+?\(.+?\(\s*implode|smi', $l_Content, $l_Found)) {
     $g_Base64[] = $l_Index;
     $g_Base64Fragment[] = getFragment($l_Content, $l_Pos);
  }

  // count number of base64_decode entries
  $l_Count = substr_count($l_Content, 'base64_decode');
  if ($l_Count > 10) {
     $g_Base64[] = $l_Index;
     $g_Base64Fragment[] = getFragment($l_Content, stripos($l_Content, 'base64_decode'));
  }


  return false;
}

///////////////////////////////////////////////////////////////////////////
function CriticalJS($l_FN, $l_Index, $l_Content)
{
  global $g_JSVirSig;

  $l_Res = false;

  foreach ($g_JSVirSig as $l_Item)
  {
    $l_Pos = stripos($l_Content, $l_Item);
    if ($l_Pos !== false) {
		return $l_Pos;
       break;
    }
  }

  return $l_Res;
}


///////////////////////////////////////////////////////////////////////////
if (!isCli()) {
   header('Content-type: text/html; charset=utf-8');
}

if (!isCli()) {

  if (isset($_GET['fn']) && ($_GET['ph'] == crc32(PASS))) {
     printFile();
     exit;
  }

  if ($_GET['p'] != PASS) {
    print "Запустите скрипт с паролем, который установлен в переменной PASS (в начале файла). <br/>Например, так http://ваш_сайт_и_путь_до_скрипта/ai-bolit.php?p=<b>qwe555</b>";
    exit;
  }
}

if (!is_readable(ROOT_PATH)) {
  print "Текущая директория не доступна для чтения скрипту. Пожалуйста, укажите права на доступ <b>rwxr-xr-x</b> или с помощью командной строки <b>chmod +r имя_директории</b>";
  exit;
}

$g_IgnoreList = array();
$g_DirIgnoreList = array();

$l_IgnoreFilename = '.aignore';
$l_DirIgnoreFilename = '.adirignore';

if (file_exists($l_IgnoreFilename)) {
    $l_IgnoreListRaw = file($l_IgnoreFilename);
    for ($i = 0; $i < count($l_IgnoreListRaw); $i++) 
    {
    	$g_IgnoreList[] = explode("\t", trim($l_IgnoreListRaw[$i]));
    }
    unset($l_IgnoreListRaw);
}

if (file_exists($l_DirIgnoreFilename)) {
    $g_DirIgnoreList = file($l_DirIgnoreFilename);
	
	for ($i = 0; $i < count($g_DirIgnoreList); $i++) {
		$g_DirIgnoreList[$i] = trim($g_DirIgnoreList[$i]);
	}
}

stdOut("Start scanning '" . ROOT_PATH . "'.");

QCR_Debug();

QCR_ScanDirectories(ROOT_PATH);

QCR_Debug();

stdOut("Founded $g_FoundTotalFiles files in $g_FoundTotalDirs directories.");
QCR_GoScan(0);

QCR_Debug();

////////////////////////////////////////////////////////////////////////////

$l_Result .= "<div class=\"sec\"><b>Отчет по " . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : realpath('.')) . "</b></div>";

$time_tacked = seconds2Human(microtime(true) - START_TIME);

$l_Result .= "<div class=\"rep\">Известно ". count($g_DBShe) ." шелл-сигнатур, а также " . (count($g_SusDB) + count($g_AdwareSig ) + count($g_JSVirSig)). " других вредоносных фрагментов. Затрачено времени: <b>$time_tacked</b
>.<br/>Сканирование начато: " . date('d-m-Y в H:i:s', floor(START_TIME)) . ". Сканирование завершено: " . date('d-m-Y в H:i:s') . ".</div> ";

$l_Result .= "<div class=\"rep\">Всего проверено $g_TotalFolder директорий и $g_TotalFiles файлов.</div>";

if (!$defaults['scan_all_files']) {
	$l_Result .= '<div class="rep" style="color: #0000A0">Внимание, скрипт выполнил быструю проверку сайта. Проверяются только наиболее критические файлы, но часть вредоносных скриптов может быть не обнаружена. Пожалуйста, запустите скрипт из командной строки для выполнения полного тестирования. Подробнее смотрите в <a href="http://revisium.com/ai/faq.php">FAQ вопрос №10</a>.</div>';
}

$l_Result .= "<div class=\"sec\">Критические замечания</div>";

$l_ShowOffer = false;

stdOut("\nBuilding report\n");

stdOut("Building list of shells\n");

if (count($g_CriticalPHP) > 0) {

  $l_Result .= "<div class=\"vir\"><b>Найдены сигнатуры шелл-скрипта. Подозрение на вредоносный скрипт:</b>";
  $l_Result .= printList($g_CriticalPHP, $g_CriticalPHPFragment, true);
  $l_Result .= "</div>";

  $l_ShowOffer = true;
} else {

  $l_Result .= '<div class="ok"><b>Шелл-скрипты не найдены.</b></div>';

}

stdOut("Building list of js");

if (count($g_CriticalJS) > 0) {
  $l_Result .= "<div class=\"vir\"><b>Найдены сигнатуры javascript вирусов:</b>";
  $l_Result .= printList($g_CriticalJS, $g_CriticalJSFragment, true);
  $l_Result .= "</div>";

  $l_ShowOffer = true;
}

stdOut("Building list of unix executables");

if (count($g_UnixExec) > 0) {
  $l_Result .= "<div class=\"vir\"><b>Найдены сигнатуры исполняемых файлов unix. Они могут быть вредоносными файлами:</b>";
  $l_Result .= printList($g_UnixExec, '', true);
  $l_Result .= "</div>";

  $l_ShowOffer = true;
}

stdOut("Building list of base64s");

if (count($g_Base64) > 0) {
  $l_ShowOffer = true;

  $l_Result .= "<div class=\"vir\"><b>Найдены длинные зашифрованные последовательности в PHP или подключение внешних файлов. Подозрение на вредоносный скрипт:</b>";
  $l_Result .= printList($g_Base64, $g_Base64Fragment, true);
  $l_Result .= "</div>";

}

stdOut("Building list of iframes");

if (count($g_Iframer) > 0) {
  $l_ShowOffer = true;

  $l_Result .= "<div class=\"vir\"><b>Подозрение на вредоносный скрипт:</b>";
  $l_Result .= printList($g_Iframer, $g_IframerFragment, true);
  $l_Result .= "</div>";

}

stdOut("Building list of susp dirs");

if (count($g_SuspDir) > 0) {

  $l_Result .= "<div class=\"vir\"><b>Скорее всего этот файл лежит в каталоге с дорвеем:</b>";
  $l_Result .= printList($g_SuspDir);
  $l_Result .= "</div>";

} else {

  $l_Result .= '<div class="ok"><b>Не найдено директорий c дорвеями</b></div>';

}

stdOut("Building list of redirects");

$l_Result .= "<div class=\"sec\">Предупреждения</div>";

if (count($g_Redirect) > 0) {

  $l_ShowOffer = true;
  $l_Result .= "<div class=\"warn\"><b>Опасный код в .htaccess (редирект на внешний сервер, подмена расширений или автовнедрение кода):</b>";
  $l_Result .= printList($g_Redirect, $g_RedirectPHPFragment, true);
  $l_Result .= "</div>";

}

stdOut("Building list of php inj");

if (count($g_PHPCodeInside) > 0) {

  $l_ShowOffer = true;
  $l_Result .= "<div class=\"warn\"><b>В не .php файле содержится стартовая сигнатура PHP кода. Возможно, там вредоносный код:</b>";
  $l_Result .= printList($g_PHPCodeInside, $g_PHPCodeInsideFragment, true);
  $l_Result .= "</div>";

}

stdOut("Building list of adware");

if (count($g_AdwareList) > 0) {
  $l_ShowOffer = true;

  $l_Result .= "<div class=\"warn\"><b>В этих файлах размещен код по продаже ссылок. Убедитесь, что размещали его вы:</b>";
  $l_Result .= printList($g_AdwareList, '', true);
  $l_Result .= "</div>";

}

stdOut("Building list of unread files");

if (count($g_NotRead) > 0) {

  $l_ShowOffer = true;
  $l_Result .= "<div class=\"warn\"><b>Непроверенные файлы - ошибка чтения:</b>";
  $l_Result .= printList($g_NotRead);
  $l_Result .= "</div>";

}
stdOut("Building list of empty links");

if (count($g_EmptyLink) > 0) {
  $l_ShowOffer = true;
  $l_Result .= "<div class=\"warn\"><b>В этих файлах размещены невидимые ссылки. Подозрение на ссылочный спам:</b>";
  $l_Result .= printList($g_EmptyLink, '', true);

  $l_Result .= 'Список невидимых ссылок:<br/>';
  
  for ($i = 0; $i < count($g_EmptyLink); $i++) {
	$l_Idx = $g_EmptyLink[$i];
    for ($j = 0; $j < count($g_EmptyLinkSrc[$l_Idx]); $j++) {
      $l_Result .= '<span class="details">' . $g_Structure['n'][$g_EmptyLink[$i]] . ' &rarr; ' . htmlspecialchars($g_EmptyLinkSrc[$l_Idx][$j][0]) . '</span><br/>';
	}
  }

  $l_Result .= "</div>";

}

stdOut("Building list of doorways");

if (count($g_Doorway) > 0) {
  $l_ShowOffer = true;

  $l_Result .= "<div class=\"warn\"><b>Найдены директории, в которых подозрительно много файлов .php или .html. Подозрение на дорвей:</b>";
  $l_Result .= printList($g_Doorway);
  $l_Result .= "</div>";

}

if (count($g_WarningPHP) > 0) {
  $l_ShowOffer = true;

  $l_Result .= "<div class=\"warn\"><b>Скрипт использует код, которые часто используются во вредоносных скриптах:</b>";


  $l_Result .= printList($g_WarningPHP, $g_WarningPHPFragment, true);
  $l_Result .= "</div>";

} else {

  $l_Result .= '<div class="ok"><b>Подозрительные скрипты не найдены</b></div>';

}

stdOut("Building list of skipped dirs");
if (count($g_SkippedFolders) > 0) {
     $l_Result .= "<div class=\"warn2\"><b>Директории из файла .adirignore были пропущены при сканировании:</b><br/>";
     $l_Result .= join("<br>", $g_SkippedFolders);
     $l_Result .= "</div>";
 }

 stdOut("Building list of writeable dirs");

if (!$defaults['no_rw_dir']) {
   if (count($g_WritableDirectories) > 0) {

     $l_Result .= "<div class=\"warn2\"><b>Потенциально небезопасно! Директории, доступные скрипту на запись:</b>";
     $l_Result .= printList($g_WritableDirectories);
     $l_Result .= "</div>";

   } else {

     $l_Result .= '<div class="ok"><b>Не найдено директорий, доступных на запись скриптом</b></div>';

   }
}


if (!isCli()) {
   $l_Result .= QCR_ExtractInfo($l_PhpInfoBody[1]);
}

$max_size_to_scan = getBytes(MAX_SIZE_TO_SCAN);
$max_size_to_scan = $max_size_to_scan > 0 ? $max_size_to_scan : getBytes('1m');

stdOut("Building list of bigfiles\n");

if (count($g_BigFiles) > 0) {

  $l_Result .= "<div class=\"warn2\"><b>Большие файлы (больше чем " . bytes2Human($max_size_to_scan) . "! Пропущено:</b>";
  $l_Result .= printList($g_BigFiles);
  $l_Result .= "</div>";

} else {
  if (SCAN_ALL_FILES) {
	$l_Result .= '<div class="ok"><b>Не найдено файлов больше чем ' . bytes2Human($max_size_to_scan) . '</b></div>';
  }
}

if (function_exists('memory_get_peak_usage')) {
  $l_Result .= 'Использовано памяти при сканировании: ' . bytes2Human(memory_get_peak_usage()) . '<p>';
}

$l_Result .= '<div id="igid" style="display: none;"><div class="sec">Добавить в список игнорируемых</div>';
$l_Result .= '<form name="ignore"><textarea name="list" style="width: 600px; height: 400px;"></textarea></form>';
$l_Result .= '<div class="details">Скопируйте этот список и вставьте его в файл .aignore, чтобы исключить эти файлы из отчета.</div></div>';

if (!SCAN_ALL_FILES) {
  $l_Result .= '<div class="notice"><span class="vir">[!]</span> В скрипте отключено полное сканирование файлов, проверяются только .php, .html, .htaccess. Чтобы выполнить более тщательное сканирование, <br/>поменяйте значение настройки на <b>\'scan_all_files\' => 1</b> в самом верху скрипта. Скрипт в этом случае может работать очень долго. Рекомендуется отключить на хостинге лимит по времени выполнения, либо запускать скрипт из командной строки.</div>';
}

$l_Result .= '<div class="footer"><div class="disclaimer"><span class="vir">[!]</span> Отказ от гарантий: даже если скрипт не нашел вредоносных скриптов на сайте, автор не гарантирует их полное отсутствие, а также не несет ответственности за возможные последствия работы скрипта ai-bolit.php или неоправданные ожидания пользователей относительно функциональности и возможностей.</div>';
$l_Result .= '<div class="thanx">Замечания и предложения по работе скрипта присылайте на <a href="mailto:audit@revisium.com">audit@revisium.com</a>.<p>Также буду чрезвычайно благодарен за любые упоминания скрипта ai-bolit на вашем сайте, в блоге, среди друзей, знакомых и клиентов. Ссылочку можно поставить на <a href="http://revisium.com/ai/">http://revisium.com/ai/</a>. <p>Если будут вопросы - пишите <a href="mailto:audit@revisium.com">audit@revisium.com</a>. Кстати, еще я написал <a href="http://sale.qpl.ru/">скрипт доски объявлений</a> и собрал точную <a href="http://gzq.ru/">базу IP</a> по городам России.</div>';
$l_Result .= '</div>';

$l_OfferVK = '<p>Если у вас есть эккаунт ВКонтакте, приглашаю в <a href="http://vk.com/siteprotect" target=_blank>группу "Безопасность Веб-сайтов"</a>: там я делюсь опытом защиты веб-сайтов и поиска вредоносных скриптов.</p>' ;
              

if ($l_ShowOffer) {
  $l_Result .= '<div class="offer" id="ofr">' .
        '<span style="font-size: 15px;"><a href="http://www.revisium.com/ru/order/" target="_blank">Лечение сайта от вирусов. Защита от взлома. Гарантия.</a></span><br/>' .
        '<p>Быстро и качественно вылечу ваш сайт от вирусов, удалю вредоносный код с сайта, проведу мероприятия по защите сайта от взлома, выполню проверку сервера на "рутования", пентест сайтов. <a href="http://www.revisium.com/ru/order/">Пишите</a>.</p>' .
        '<a href="http://www.revisium.com/ru/order/" target="_blank">www.revisium.com &rarr;</a><p>' .
        '<p>Также приглашаю в <a href="http://vk.com/siteprotect" style="color: white" target="_blank">группу ВКонтакте: "Безопасность Веб-сайтов"</a>' .
        '<p><a href="#" onclick="document.getElementById(\'ofr\').style.display=\'none\'" style="color: #303030">[x] закрыть сообщение</a></p>' .
        '</div>';
} else {
  $l_Result .= '<div class="offer2" id="ofr2">' . $l_OfferVK .
        '<p><a href="#" onclick="document.getElementById(\'ofr2\').style.display=\'none\'" style="color: #303030">[x] закрыть сообщение</a></p>' .
        '</div>';
}

////////////////////////////////////////////////////////////////////////////

print $l_Result;

QCR_Debug('Before ob_get_clean()');

$l_Result = ob_get_clean();

QCR_Debug('After ob_get_clean()');

if (!isCli())
{
	echo $l_Result;
	exit;
}

if (!defined('REPORT') OR REPORT === '')
{
	die('Report not written.');
}

$emails = getEmails(REPORT);

if (!$emails)
{
	if (defined('REPORT_PATH') AND REPORT_PATH)
	{
		if (!is_writable(REPORT_PATH))
		{
			stdOut("\nCannot write report. Report dir " . REPORT_PATH . " is not writable.");
		}

		else if (!REPORT_FILE)
		{
			stdOut("\nCannot write report. Report filename is empty.");
		}

		else if (($file = REPORT_PATH . DIRECTORY_SEPARATOR . REPORT_FILE) AND is_file($file) AND !is_writable($file))
		{
			stdOut("\nCannot write report. Report file '$file' exists but is not writable.");
		}

		else
		{
			file_put_contents($file, $l_Result);
			stdOut("\nReport written to '$file'.");
		}
	}
}
else
{
	$headers = array(
		'MIME-Version: 1.0',
		'Content-type: text/html; charset=UTF-8',
		'From: ' . ($defaults['email_from'] ? $defaults['email_from'] : 'AI-Bolit@myhost')
	);

	for ($i = 0, $size = sizeof($emails); $i < $size; $i++)
	{
		@mail($emails[$i], 'AI-Bolit Report ' . date("d/m/Y H:i", time()), $l_Result, implode("\r\n", $headers));
	}

	stdOut("\nReport sended to " . implode(', ', $emails));
}

$time_taken = microtime(true) - START_TIME;
$time_taken = number_format($time_taken, 5);

stdOut("Scanning complete! Time taken: " . seconds2Human($time_taken));

QCR_Debug();

