<?php
$url=$_SERVER['REQUEST_URI'];

$folder = 'file://'.$_SERVER['DOCUMENT_ROOT'].'/cms/assets/';
$pubKey = openssl_pkey_get_public($folder.'publickey');
$privateKey = openssl_pkey_get_private($folder.'privatekey', "toprides");

$urltitle1 = explode('admin/', $url);
if(isset($urltitle1[1])){
$urltitle2 = $urltitle1[1];
}
else{
$urltitle2 = $urltitle1[0];
}
$urltitle3 = explode('?', $urltitle2);
$urltitle=$urltitle3[0];
$table_language = 'settings';
$select_data_language = "*";
$this->db->select($select_data_language);
$query_language = $this->db->get($table_language);
$result_language = $query_language->result_array();
if(!empty($result_language)) 
    $language=$result_language[0]['languagetr'];
else 
    $language = 1 ;

  $Manage_staff='Manage Staff';
  $Add_staff='Add Staff';
  $Bank_Details_lng='Bank Details';
  $Bank_name='Bank Name';
  $Bank_number='Bank Number';
  $Bank_routing='Bank Routing';

  $driver_ssn='SSN';


if($language == 1)
{
    $profile_title_lng = 'Profile';
    $change_passwor_lng='Change Password';
    $logout_lng='Logout';
    $header_title = 'Top Ridez';
    $footer='Powered by Top Ridez.';
    $dashboard_lng='Dashboard';
    $Online_lng='Online';
    $Real_Time_Mapping_lng='Real Time Mapping';
    $Daily_Driver_Earnings_lng='Daily Driver Earnings';
    $All_Users_lng='All Users';
    $Flagged_Users_lng='Flagged Users';
    $Manage_User_lng='Manage User';
    $Manage_Booking_lng='Manage Booking';
    $All_Booking_lng='All Booking';
    $Pending_Booking_lng='Pending Booking';
    $Completed_Booking_lng='Completed Booking';
    $User_Cancelled_Booking_lng='User Cancelled Booking';
    $Driver_Cancelled_Booking_lng='Driver Cancelled Booking';
    $Manage_Driver_lng='Manage Driver';
    $All_Drivers_lng='All Drivers';
    $Flagged_Drivers_lng='Flagged Drivers';
    $Manage_Car_Type_lng='Manage Car Type';
    $Manage_Delay_Reasons_lng='Manage Delay Reasons';
    $Settings_lng='Settings';
    $Cashout_lng='Cash Out';
    $Manage_cashout = 'Manage Cashout';
    $Update_Setting_lng='Update Setting';
    $Fix_Price_Area_lng='Fix Price Area';
    $Manage_Day_Time_lng='Manage Day Time';
    $Commision_Setting_lng='Commision Setting';
}
elseif($language == 2)
{
    $profile_title_lng = 'Profil';
    $change_passwor_lng="Изменить пароль";
    $logout_lng='Ausloggen';
    $footer='Powered by OK Schweiz.';
    $dashboard_lng='Instrumententafel';
    $Online_lng='Online';
    $Real_Time_Mapping_lng='Echtzeit-Mapping';
    $Daily_Driver_Earnings_lng='Daily Driver Earnings';
    $All_Users_lng='Alle Nutzer';
    $Flagged_Users_lng='Angezeigte Benutzer';
    $Manage_User_lng='Benutzer verwalten';
    $Manage_Booking_lng='Buchungen verwalten';
    $All_Booking_lng='Alle Buchungen';
    $Pending_Booking_lng='Ausstehende Buchung';
    $Completed_Booking_lng='Abgeschlossene Buchung';
    $User_Cancelled_Booking_lng='Stornierte Buchungen';
    $Driver_Cancelled_Booking_lng='Treiber stornierte Buchung';
    $Manage_Driver_lng='Treiber verwalten';
    $All_Drivers_lng='Alle Treiber';
    $Flagged_Drivers_lng='Markierte Treiber';
    $Manage_Car_Type_lng='Verwalten Sie Auto-Typ';
    $Manage_Delay_Reasons_lng='Verwalten Sie Verzögerungsgründe';
    $Settings_lng='Einstellungen';
    $Update_Setting_lng='Einstellung aktualisieren';
    $Fix_Price_Area_lng='Fix Preisbereich';
    $Manage_Day_Time_lng='Tageszeit verwalten';
    $Commision_Setting_lng='Einstellung Commision';
}
elseif($language == 3)
{
    $profile_title_lng = 'Profilo';
    $change_passwor_lng="Passwort ändern";
    $logout='Disconnettersi';
    $footer='Realizzato da OK Svizzera.';
    $dashboard_lng='scrivania';
    $Online_lng='online';
    $Real_Time_Mapping_lng='Mappatura tempo reale';
    $Daily_Driver_Earnings_lng='Daily Driver Earnings';
    $All_Users_lng='Tutti gli utenti';
    $Flagged_Users_lng='Gli utenti contrassegnati';
    $Manage_User_lng='Gestisci utente';
    $Manage_Booking_lng='Gestisci prenotazione';
    $All_Booking_lng='Tutte le prenotazioni';
    $Pending_Booking_lng='In attesa di Booking';
    $Completed_Booking_lng='prenotazione compilato';
    $User_Cancelled_Booking_lng='Prenotazioni Annullato utente';
    $Driver_Cancelled_Booking_lng='Autista Prenotazioni Annullato';
    $Manage_Driver_lng='gestire driver';
    $All_Drivers_lng='tutti i driver';
    $Flagged_Drivers_lng='Driver contrassegnati';
    $Manage_Car_Type_lng='Gestire Tipo auto';
    $Manage_Delay_Reasons_lng='Gestire motivi dei ritardi';
    $Settings_lng='impostazioni';
    $Update_Setting_lng='Aggiornamento Impostazione';
    $Fix_Price_Area_lng='Fissare il prezzo Area';
    $Manage_Day_Time_lng='Gestire Day Time';
    $Commision_Setting_lng='Commision Impostazione';
}
elseif($language == 4)
{
    $profile_title_lng = 'Профиль';
    $change_passwor_lng="Cambia la password";
    $logout_lng='Выйти';
    $footer='Работает на OK Швейцарии.';
    $dashboard_lng='Tableau de bord';
    $Online_lng='В сети';
    $Real_Time_Mapping_lng='Real Time Mapping';
    $Daily_Driver_Earnings_lng='Daily Driver Earnings';
    $All_Users_lng='Все пользователи';
    $Flagged_Users_lng='Помеченные Пользователи';
    $Manage_User_lng='Управление учетными записями пользователей';
    $Manage_Booking_lng='Управление бронированием';
    $All_Booking_lng='Все бронирования';
    $Pending_Booking_lng='Запрос на бронирование';
    $Completed_Booking_lng='Завершена бронирование';
    $User_Cancelled_Booking_lng='Пользователь Отменено Бронирование';
    $Driver_Cancelled_Booking_lng='Водитель Отменено бронирование';
    $Manage_Driver_lng='Управление драйвера';
    $All_Drivers_lng='Все драйверы';
    $Flagged_Drivers_lng='Помеченные Драйверы';
    $Manage_Car_Type_lng='Управление Тип автомобиля';
    $Manage_Delay_Reasons_lng='Управление Причины Задержка';
    $Settings_lng='настройки';
    $Update_Setting_lng='Update Setting';
    $Fix_Price_Area_lng='Фикс Цена Площадь';
    $Manage_Day_Time_lng='Управление в дневное время';
    $Commision_Setting_lng='Commision Окружение';
}
elseif($language == 5)
{
    $profile_title_lng = 'Profil';
    $change_passwor_lng="Changer le mot de passe";
    $logout_lng='Se déconnecter';
    $footer='Propulsé par OK Suisse.';
    $dashboard_lng='Tableau de bord';
    $Online_lng='En ligne';
    $Real_Time_Mapping_lng='Cartographie en temps réel';
    $Daily_Driver_Earnings_lng='Daily Driver Earnings';
    $All_Users_lng='Tous les utilisateurs';
    $Flagged_Users_lng='Utilisateurs marqués';
    $Manage_User_lng='Gérer l`utilisateur';
    $Manage_Booking_lng='Gérer la réservation';
    $All_Booking_lng='Toutes les réservations';
    $Pending_Booking_lng='Réservation en attente';
    $Completed_Booking_lng='Réservation terminée';
    $User_Cancelled_Booking_lng='Réservation annulée par l ` utilisateur';
    $Driver_Cancelled_Booking_lng='Réservation annulée par le conducteur';
    $Manage_Driver_lng='Gérer le pilote';
    $All_Drivers_lng='Tous les pilotes';
    $Flagged_Drivers_lng='Pilotes marqués';
    $Manage_Car_Type_lng='Gérer le type de voiture';
    $Manage_Delay_Reasons_lng='Gérer les raisons de retard';
    $Settings_lng='Paramètres';
    $Update_Setting_lng='Réglage de la mise à jour';
    $Fix_Price_Area_lng='Fixer la zone de prix';
    $Manage_Day_Time_lng='Gérer le jour';
    $Commision_Setting_lng='Commision Setting';

}
elseif($language == 6)
{

    $profile_title_lng = 'Профил';
    $change_passwor_lng='Промени парола';
    $logout_lng='Изход';
    $footer='Осъществено от <a href="http://studioweb.bg/">SW</a>';
    $dashboard_lng='Табло';
    $Online_lng='На линия';
    $Real_Time_Mapping_lng='Карта в реално време';
    $Daily_Driver_Earnings_lng='Дневни доходи';
    $All_Users_lng='Всички потребители';
    $Flagged_Users_lng='Маркирани потребители';
    $Manage_User_lng='Потребители';
    $Manage_Booking_lng='Поръчки';
    $All_Booking_lng='Всички поръчки';
    $Pending_Booking_lng='Чакащи поръчки';
    $Completed_Booking_lng='Завършени поръчки';
    $User_Cancelled_Booking_lng='Отменени поръчки (потр.)';
    $Driver_Cancelled_Booking_lng='Отменени поръчки (шоф.)';
    $Manage_Driver_lng='Шофьори';
    $All_Drivers_lng='Всички шофьори';
    $Flagged_Drivers_lng='Маркирани шофьори';
    $Manage_Car_Type_lng='Категории коли';
    $Manage_Delay_Reasons_lng='Причини за забавяне';
    $Settings_lng='Настройки';
    $Update_Setting_lng='Настройки';
    $Fix_Price_Area_lng='Цена Площ';
    $Manage_Day_Time_lng='Работно време';
    $Commision_Setting_lng='Комисионна';
}
if($urltitle == 'manage_user')
{
    if($language == 1)
    {
        $Manage_User_lng = 'Manage User';
        $home_lng='HOME';
        $User_Image_lng='User Image';
        $User_Name_lng='User Name';
        $Email_lng='Email';
        $Gender_lng='Gender';
        $Mobile_lng='Mobile';
        $Status_lng='Status';
        $Action_lng='Action';
        $single_delete_alert_lng='Are you sure you want to delete the selected user?';
        $OK_lng='OK';
        $CANCEL_lng='CANCEL';
        $Multiple_Delete_lng='Multiple Delete';
    }
    elseif($language == 2)
    {
        $Manage_User_lng='Benutzer verwalten';
        $home_lng='ZUHAUSE';
        $User_Image_lng='Benutzerbild';
        $User_Name_lng='Benutzername';
        $Email_lng='Email';
        $Gender_lng='Geschlecht';
        $Mobile_lng='Mobile';
        $Status_lng='Status';
        $Action_lng='Aktion';
        $single_delete_alert_lng='Möchten Sie den ausgewählten Benutzer wirklich löschen?';
        $OK_lng='OK';
        $CANCEL_lng='STORNIEREN';
        $Multiple_Delete_lng='Mehrfach löschen';
    }
    elseif($language == 3)
    {
        $Manage_User_lng='Gestisci utente';
        $home_lng='CASA';
        $User_Imagev='Immagine dell ` utente';
        $User_Name_lng='Nome utente';
        $Email_lng='E-mail';
        $Gender_lng='Genere';
        $Mobile_lng='Mobile';
        $Status_lng='Stato';
        $Action_lng='Azione';
        $single_delete_alert_lng='Sei sicuro di voler eliminare l`utente selezionato?';
        $OK_lng='ok';
        $CANCEL_lng='ANNULLA';
        $Multiple_Delete_lng='Elimina multipla';
    }
    elseif($language == 4)
    {
        $Manage_User_lng='Управление учетными записями пользователей';
        $home_lng='ГЛАВНАЯ';
        $User_Image_lng='Пользователь изображение';
        $User_Name_lng='имя пользователя';
        $Email_lng='Эл. адрес';
        $Gender_lng='Пол';
        $Mobile_lng='мобильный';
        $Status_lng='Положение дел';
        $Action_lng='действие';
        $single_delete_alert_lng='Вы уверены, что хотите удалить выбранного пользователя?';
        $OK_lng='ОК';
        $CANCEL_lng='ОТМЕНА';
        $Multiple_Delete_lng='Удалить несколько';
    }
    elseif($language == 5)
    {
        $Manage_User_lng='Gérer l utilisateur';
        $home_lng='DOMICILE';
        $User_Image_lng='Image de l ` utilisateur';
        $User_Name_lng='Nom d ` utilisateur';
        $Email_lng='Email';
        $Gender_lng='Le genre';
        $Mobile_lng='Mobile';
        $Status_lng='statut';
        $Action_lng='action';
        $single_delete_alert_lng='Voulez-vous vraiment supprimer l`utilisateur sélectionné?';
        $OK_lng='D`accord';
        $CANCEL_lng='ANNULER';
        $Multiple_Delete_lng='Suppression multiple';
    }
    elseif($language == 6)
    {
        $Manage_User_lng='Потребители';
        $home_lng='Начало';
        $User_Image_lng='Изображение';
        $User_Name_lng='Потребителско име';
        $Email_lng='Email';
        $Gender_lng='Пол';
        $Mobile_lng='Телефон';
        $Status_lng='Статус';
        $Action_lng='Действия';
        $single_delete_alert_lng='Сигурни ли сте, че искате да изтриете избрания потребител?';
        $OK_lng='ОК';
        $CANCEL_lng='ОТКАЗ';
        $Multiple_Delete_lng='Изтриване на избраните';
    }

}
elseif($urltitle == 'update_settings')
{
    if($language == 1)
    {
        $setting_lng='Setting';
        $home_lng='HOME';
        $country_lng='country';
        $currency_lng='currency';
        $Language_lng='Language';
        $SUBMIT_lng='SUBMIT';
    }
    elseif($language == 2)
    {
        $setting_lng='Rahmen';
        $home_lng='ZUHAUSE';
        $country_lng='Land';
        $currency_lng='Währung';
        $Language_lng='Sprache';
        $SUBMIT_lng='EINREICHEN';
    }
    elseif($language == 3)
    {
        $setting_lng='ambiente';
        $home_lng='CASA';
        $country_lng='nazione';
        $currency_lng='moneta';
        $Language_lng='Lingua';
        $SUBMIT_lng='INVIO';
    }
    elseif($language == 4)
    {
        $setting_lng='настройка';
        $home_lng='ГЛАВНАЯ';
        $country_lng='страна';
        $currency_lng='валюта';
        $Language_lng='язык';
        $SUBMIT_lng='ОТПРАВИТЬ';
    }
    elseif($language == 5)
    {
        $setting_lng='Réglage';
        $home_lng='DOMICILE';
        $country_lng='Pays';
        $currency_lng='devise';
        $Language_lng='La langue';
        $SUBMIT_lng='SOUMETTRE';
    }
    elseif($language == 6)
    {
        $setting_lng='Настройки';
        $home_lng='Начало';
        $country_lng='Държава';
        $currency_lng='Валута';
        $Language_lng='Език';
        $SUBMIT_lng='Запази';
    }

}
elseif($urltitle == 'dashboard')
{
    if($language == 1)
    {
        $setting='Setting';
        $home='HOME';
        $dashboard='Dashboard';
        $Driver_Unavailable ='Driver Unavailable';
        $Money_Earned='Money Earned';
        $Users='Users';
        $Drivers='Drivers';
        $Successful_Booking='Successful Booking';
        $Pending_Booking='Pending Booking';
        $User_Canceled='User Canceled';
        $Driver_Canceled='Driver Canceled';
        $Pending='Pending';
        $Read_more='Read more';
        $Waiting='Waiting';
        $Accepted='Accepted';
        $Driver_Arrived='Driver Arrived';
        $On_Trip='On Trip';
        $Completed='Completed';
        $Rides='Rides';
        $Earnings='Earnings';

    }
    elseif($language == 2)
    {
        $dashboard='Instrumententafel';
        $home='ZUHAUSE';
        $Driver_Unavailable='Treiber nicht verfügbar';
        $Money_Earned='Verdientes Geld';
        $Users='Benutzer';
        $Drivers='Treiber';
        $Successful_Booking='Erfolgreiche Buchung';
        $Pending_Booking='Ausstehende Buchung';
        $User_Canceled='Benutzer abgebrochen';
        $Driver_Canceled='Treiber abgebrochen';
        $Pending='Ausstehend';
        $Read_more='Weiterlesen';
        $Waiting='Warten';
        $Accepted='Akzeptiert';
        $Driver_Arrived='Fahrer angekommen';
        $On_Trip='Auf Reise';
        $Completed='Abgeschlossen';
        $Rides='Fahrten';
        $Earnings='Verdienste';
    }
    elseif($language == 3)
    {
        $dashboard='scrivania';
        $home='CASA';
        $Driver_Unavailable='autista disponibile';
        $Money_Earned='soldi guadagnati';
        $Users='utenti';
        $Drivers='Autisti';
        $Successful_Booking='Prenotazioni di successo';
        $Pending_Booking='In attesa di Booking';
        $User_Canceled='utente ha annullato';
        $Driver_Canceled='autista Annullato';
        $Pending='in attesa di';
        $Read_more='Leggi di più';
        $Waiting='In attesa';
        $Accepted='Accettato';
        $Driver_Arrived='autista arrivati';
        $On_Trip='su di viaggio';
        $Completed='Completato';
        $Rides='Cavalcate';
        $Earnings='guadagni';
    }
    elseif($language == 4)
    {
        $dashboard='Панель приборов';
        $home='ГЛАВНАЯ';
        $Driver_Unavailable='Водитель Недоступен';
        $Money_Earned='Заработанные деньги';
        $Users='пользователей';
        $Drivers='Драйверы';
        $Successful_Booking='Успешное бронирование';
        $Pending_Booking='Запрос на бронирование';
        $User_Canceled='Пользователь Отменено';
        $Driver_Canceled='Драйвер Отменено';
        $Pending='в ожидании';
        $Read_more='Прочитайте больше';
        $Waiting='ожидание';
        $Accepted='Принято';
        $Driver_Arrived='Водитель Прибыл';
        $On_Trip='О поездке';
        $Completed='Завершенный';
        $Rides='Аттракционы';
        $Earnings='прибыль';

    }
    elseif($language == 5)
    {
        $dashboard='Tableau de bord';
        $home='DOMICILE';
        $Driver_Unavailable='Pilote indisponible';
        $Money_Earned='L`argent gagné';
        $Users='Utilisateurs';
        $Drivers='Pilotes';
        $Successful_Booking='Réservation réussie';
        $Pending_Booking='Réservation en attente';
        $User_Canceled='Utilisateur annulé';
        $Driver_Canceled='Conducteur annulé';
        $Pending='en attendant';
        $Read_more='Lire la suite';
        $Waiting='Attendre';
        $Accepted='Accepté';
        $Driver_Arrived='Conducteur arrivé';
        $On_Trip='En voyage';
        $Completed='Terminé';
        $Rides='Manèges';
        $Earnings='Gains';
    }
    elseif($language == 6)
    {
        $dashboard='Табло';
        $home='Начало';
        $Driver_Unavailable='Неналичен шофьор';
        $Money_Earned='Заработени пари';
        $Users='Потребители';
        $Drivers='Шофьори';
        $Successful_Booking='Успешна поръчка';
        $Pending_Booking='Чакаща поръчка';
        $User_Canceled='Отменена поръчка (потр.)';
        $Driver_Canceled='Отменена поръчка (шоф.)';
        $Pending='Чакащ';
        $Read_more='Виж още';
        $Waiting='Чакащ';
        $Accepted='Приет';
        $Driver_Arrived='Пристигнал шофьор';
        $On_Trip='Пътуване';
        $Completed='Завършен';
        $Rides='Пътувания';
        $Earnings='Печалба';
    }

}
elseif($urltitle == 'real_time_mapping')
{
    if($language == 1)
    {
        $home_lng='HOME';
        $Rides_lng='Rides';
        $Earnings_lng='Earnings';
        $Real_Time_Mapping_lng='Real Time Mapping';
        $Driver_Status_lng='Driver Status';
        $Online_lng='Online';
        $Offline_lng='Offline';
        $Busy_lng='Busy';
        $Enter_a_location_lng='Enter a location';
    }
    elseif($language == 2)
    {
        $home_lng='ZUHAUSE';
        $Rides_lng='Fahrten';
        $Earnings_lng='Verdienste';
        $Real_Time_Mapping_lng='Echtzeit-Mapping';
        $Driver_Status_lng='Treiberstatus';
        $Online_lng='Online';
        $Offline_lng='Offline';
        $Busy_lng='Beschäftigt';
        $Enter_a_location_lng='Geben Sie einen Standort ein';
    }
    elseif($language == 3)
    {
        $home_lng='CASA';
        $Rides_lng='Cavalcate';
        $Earnings_lng='guadagni';
        $Real_Time_Mapping_lng='Mappatura tempo reale';
        $Driver_Status_lng='stato del driver';
        $Online_lng='online';
        $Offline_lng='disconnesso';
        $Busy_lng='Occupato';
        $Enter_a_location_lng='Inserisci una località';
    }
    elseif($language == 4)
    {
        $home_lng='ГЛАВНАЯ';
        $Rides_lng='Аттракционы';
        $Earnings_lng='прибыль';
        $Real_Time_Mapping_lng='Real Time Mapping';
        $Driver_Status_lng='Состояние водителя';
        $Online_lng='В сети';
        $Offline_lng='Не в сети';
        $Busy_lng='Занятый';
        $Enter_a_location_lng='Введите местоположение';
    }
    elseif($language == 5)
    {
        $home_lng='DOMICILE';
        $Rides_lng='Manèges';
        $Earnings_lng='Gains';
        $Real_Time_Mapping_lng='Cartographie en temps réel';
        $Driver_Status_lng='Statut du pilote';
        $Online_lng='En ligne';
        $Offline_lng='Hors ligne';
        $Busy_lng='Occupé';
        $Enter_a_location_lng='Entrez un emplacement';
    }
    elseif($language == 6)
    {
        $home_lng='Начало';
        $Rides_lng='Пътувания';
        $Earnings_lng='Печалба';
        $Real_Time_Mapping_lng='Карта в реално време';
        $Driver_Status_lng='Статус на шофьор';
        $Online_lng='На линия';
        $Offline_lng='Извън линия';
        $Busy_lng='Зает';
        $Enter_a_location_lng='Въведете местоположение';
    }
}
elseif($urltitle == 'view_userdetails')
{
    if($language == 1)
    {
        $User_Details_lng='User Details';
        $home_lng='HOME';
        $USERS_lng='USERS';
        $Booked_Cabs_lng='Booked Cabs';
        $Driver_Unavailable_lng ='Driver Unavailable';
        $Cancelled_lng='Cancelled';
        $Pending_Booking_lng='Pending Booking';
        $User_Canceled_lng='User Canceled';
        $Driver_Canceled_lng='Driver Canceled';
        $Pending_lng='Pending';
        $Read_more_lng='Read more';
        $Waiting_lng='Waiting';
        $Accepted_lng='Accepted';
        $Driver_Arrived_lng='Driver Arrived';
        $On_Trip_lng='On Trip';
        $Completed_lng='Completed';
        $No_Data_lng='No Data';
        $Total_Spend_lng='Total Spend';
        $Mobile_No_lng='Mobile No';
        $Change_Password_lng='Change Password';
    }
    elseif($language == 2)
    {
        $User_Details_lng='Nutzerdetails';
        $home_lng='ZUHAUSE';
        $USERS_lng='BENUTZER';
        $Booked_Cabs_lng='Reservierte Cabs';
        $Cancelled_lng='Abgebrochen';
        $Driver_Unavailable_lng='Treiber nicht verfügbar';
        $Successful_Booking_lng='Erfolgreiche Buchung';
        $Pending_Booking_lng='Ausstehende Buchung';
        $User_Canceled_lng='Benutzer abgebrochen';
        $Driver_Canceled_lng='Treiber abgebrochen';
        $Pending_lng='Ausstehend';
        $Read_more_lng='Weiterlesen';
        $Waiting_lng='Warten';
        $Accepted_lng='Akzeptiert';
        $Driver_Arrived_lng='Fahrer angekommen';
        $On_Trip_lng='Auf Reise';
        $Completed_lng='Abgeschlossen';
        $No_Data_lng='Keine Daten';
        $Total_Spend_lng='Gesamtausgaben';
        $Mobile_No_lng='Mobil - Nr';
        $Change_Password_lng='Passwort ändern';
    }
    elseif($language == 3)
    {
        $User_Details_lng='Dettagli utente';
        $home_lng='CASA';
        $USERS_lng='UTENTI';
        $Booked_Cabs_lng='Cabs prenotati';
        $Cancelled_lng='Annullato';
        $Driver_Unavailable_lng='autista disponibile';
        $Successful_Booking_lng='Prenotazioni di successo';
        $Pending_Booking_lng='In attesa di Booking';
        $User_Canceled_lng='utente ha annullato';
        $Driver_Canceled_lng='autista Annullato';
        $Pending_lng='in attesa di';
        $Read_more_lng='Leggi di più';
        $Waiting_lng='In attesa';
        $Accepted_lng='Accettato';
        $Driver_Arrived_lng='autista arrivati';
        $On_Trip_lng='su di viaggio';
        $Completed_lng='Completato';
        $No_Data_lng='Nessun dato';
        $Total_Spend_lng='spesa totale';
        $Mobile_No_lng='cellulare No';
        $Change_Password_lng='Cambia la password';
    }
    elseif($language == 4)
    {
        $User_Details_lng='Сведения о пользователе';
        $home_lng='ГЛАВНАЯ';
        $USERS_lng='пОЛЬЗОВАТЕЛЕЙ';
        $Booked_Cabs_lng='Занято Кабинки';
        $Cancelled_lng='Отменено';
        $Driver_Unavailable_lng='Водитель Недоступен';
        $Successful_Booking_lng='Успешное бронирование';
        $Pending_Booking_lng='Запрос на бронирование';
        $User_Canceled_lng='Пользователь Отменено';
        $Driver_Canceled_lng='Драйвер Отменено';
        $Pending_lng='в ожидании';
        $Read_more_lng='Прочитайте больше';
        $Waiting_lng='ожидание';
        $Accepted_lng='Принято';
        $Driver_Arrived_lng='Водитель Прибыл';
        $On_Trip_lng='О поездке';
        $Completed_lng='Завершенный';
        $Rides_lng='Аттракционы';
        $Earnings_lng='прибыль';
        $No_Data_lng='Нет данных';
        $Total_Spend_lng='Общие расходы по';
        $Mobile_No_lng='Номер мобильного';
        $Change_Password_lng='Изменить пароль';
    }
    elseif($language == 5)
    {
        $User_Details_lng='Détails de l`utilisateur';
        $home_lng='DOMICILE';
        $USERS_lng='UTILISATEURS';
        $Booked_Cabs_lng='Réservé aux taxis';
        $Cancelled_lng='Annulé';
        $Driver_Unavailable_lng='Pilote indisponible';
        $Successful_Booking_lng='Réservation réussie';
        $Pending_Booking_lng='Réservation en attente';
        $User_Canceled_lng='Utilisateur annulé';
        $Driver_Canceled_lng='Conducteur annulé';
        $Pending_lng='en attendant';
        $Read_more_lng='Lire la suite';
        $Waiting_lng='Attendre';
        $Accepted_lng='Accepté';
        $Driver_Arrived_lng='Conducteur arrivé';
        $On_Trip_lng='En voyage';
        $Completed_lng='Terminé';
        $No_Data_lng='Pas de données';
        $Total_Spend_lng='Dépenses totales';
        $Mobile_No_lng='Mobile Non';
        $Change_Password_lng='Changer le mot de passe';
    }
    elseif($language == 6)
    {
        $User_Details_lng='Детайли';
        $home_lng='Начало';
        $USERS_lng='ПОТРЕБИТЕЛИ';
        $Booked_Cabs_lng='Поръчани таксита';
        $Cancelled_lng='Отменен';
        $Driver_Unavailable_lng='Неналичен шофьор';
        $Successful_Booking_lng='Успешна поръчка';
        $Pending_Booking_lng='Чакаща поръчка';
        $User_Canceled_lng='Отменена поръчка (потр.)';
        $Driver_Canceled_lng='Отменена поръчка (шоф.)';
        $Pending_lng='Чакащ';
        $Read_more_lng='Виж още';
        $Waiting_lng='Чакащ';
        $Accepted_lng='Приет';
        $Driver_Arrived_lng='Пристигнал';
        $On_Trip_lng='Пътуване';
        $Completed_lng='Завършен';
        $No_Data_lng='Няма данни';
        $Total_Spend_lng='Общо разходи';
        $Mobile_No_lng='Телефон';
        $Change_Password_lng='Смяна на парола';
    }
}
elseif($urltitle == 'user_change_password')
{
    if($language == 1)
    {
        $home_lng='HOME';
        $Change_Password_lng='Change Password';
        $New_Password_lng='New Password';
        $Enter_New_Password_lng='Enter New Password';
        $Enter_Confirm_Password_lng='Enter Confirm Password';
        $Confirm_Password_lng='Confirm Password';
        $SUBMIT_lng='SUBMIT';
    }
    elseif($language == 2)
    {
        $home_lng='ZUHAUSE';
        $Change_Password_lng='Passwort ändern';
        $New_Password_lng='Neues Kennwort';
        $Enter_New_Password_lng='Neues Passwort eingeben';
        $Enter_Confirm_Password_lng='Geben Sie Kennwort bestätigen ein';
        $Confirm_Password_lng='Bestätige das Passwort';
        $SUBMIT_lng='EINREICHEN';
    }
    elseif($language == 3)
    {
        $home_lng='CASA';
        $Change_Password_lng='Cambia la password';
        $New_Password_lng='nuova password';
        $Enter_New_Password_lng='Inserire una nuova password';
        $Enter_Confirm_Password_lng='Invio Conferma password';
        $Confirm_Password_lng='conferma password';
        $SUBMIT_lng='INVIO';
    }
    elseif($language == 4)
    {
        $home_lng='ГЛАВНАЯ';
        $Change_Password_lng='Изменить пароль';
        $New_Password_lng='новый пароль';
        $Enter_New_Password_lng='Введите новый пароль';
        $Enter_Confirm_Password_lng='Enter Подтверждение пароля';
        $Confirm_Password_lng='Подтвердите Пароль';
        $SUBMIT_lng='ОТПРАВИТЬ';
    }
    elseif($language == 5)
    {
        $home_lng='DOMICILE';
        $Change_Password_lng='Changer le mot de passe';
        $New_Password_lng='nouveau mot de passe';
        $Enter_New_Password_lng='Entrez un nouveau mot de passe';
        $Enter_Confirm_Password_lng='Entrer Confirmer mot de passe';
        $Confirm_Password_lng='Confirmez le mot de passe';
        $SUBMIT_lng='SOUMETTRE';
    }
    elseif($language == 6)
    {
        $home_lng='Начало';
        $Change_Password_lng='Смяна на парола';
        $New_Password_lng='Нова парола';
        $Enter_New_Password_lng='Въведи новата парола';
        $Enter_Confirm_Password_lng='Потвърдете паролата';
        $Confirm_Password_lng='Потвърди парола';
        $SUBMIT_lng='Запази';
    }
}
elseif($urltitle == 'manage_booking')
{
    if($language == 1)
    {
        $home_lng='HOME';
        $Manage_Booking_lng='Manage Booking';
        $User_Name_lng='User Name';
        $User_ID_lng='User ID';
        $Booking_ID_lng='Booking ID';
        $Taxi_Type_lng='Taxi Type';
        $From_lng='From';
        $To_lng='To';
        $Date_lng='Date';
        $Status_lng='Status';
        $Action_lng='Action';
        $single_delete_alert_lng='Are you sure you want to delete the selected booking?';
        $OK_lng='OK';
        $CANCEL_lng='CANCEL';
        $Multiple_Delete_lng='Multiple Delete';
    }
    elseif($language == 2)
    {
        $home_lng='ZUHAUSE';
        $Manage_Booking_lng='Buchungen verwalten';
        $User_Name_lng='Benutzername';
        $User_ID_lng='Benutzeridentifikation';
        $Booking_ID_lng='Buchungs-ID';
        $Taxi_Type_lng='Taxi-Art';
        $From_lng='Von';
        $To_lng='Nach';
        $Date_lng='Datum';
        $Status_lng='Status';
        $Action_lng='Aktion';
        $single_delete_alert_lng='Möchten Sie die ausgewählte Buchung wirklich löschen?';
        $OK_lng='OK';
        $CANCEL_lng='STORNIEREN';
        $Multiple_Delete_lng='Mehrfach löschen';
    }
    elseif($language == 3)
    {
        $home_lng='CASA';
        $Manage_Booking_lng='Gestisci prenotazione';
        $User_Name_lng='Nome utente';
        $User_ID_lng='ID utente';
        $Booking_ID_lng='Prenotazioni ID';
        $Taxi_Type_lng='Tipo di taxi';
        $From_lng='Da parte di';
        $To_lng='A';
        $Date_lng='Data';
        $Status_lng='Stato';
        $Action_lng='Azione';
        $single_delete_alert_lng='Sei sicuro di voler cancellare la prenotazione selezionato?';
        $OK_lng='ok';
        $CANCEL_lng='ANNULLA';
        $Multiple_Delete_lng='Elimina multipla';
    }
    elseif($language == 4)
    {
        $home_lng='ГЛАВНАЯ';
        $Manage_Booking_lng='Управление бронированием';
        $User_Name_lng='имя пользователя';
        $User_ID_lng='Идентификатор пользователя';
        $Booking_ID_lng='Бронирование ID';
        $Taxi_Type_lng='Тип такси';
        $From_lng='Из';
        $To_lng='к';
        $Date_lng='Дата';
        $Status_lng='Положение дел';
        $Action_lng='действие';
        $single_delete_alert_lng='Вы уверены, что хотите удалить выбранный номер?';
        $OK_lng='ОК';
        $CANCEL_lng='ОТМЕНА';
        $Multiple_Delete_lng='Удалить несколько';
    }
    elseif($language == 5)
    {
        $home_lng='DOMICILE';
        $Manage_Booking_lng='Gérer la réservation';
        $User_Name_lng='Nom d`utilisateur';
        $User_ID_lng='Identifiant d`utilisateur';
        $Booking_ID_lng='ID de réservation';
        $Taxi_Type_lng='Type de taxi';
        $From_lng='De';
        $To_lng='À';
        $Date_lng='date';
        $Status_lng='statut';
        $Action_lng='action';
        $single_delete_alert_lng='Voulez-vous vraiment supprimer la réservation sélectionnée?';
        $OK_lng='D`accord';
        $CANCEL_lng='ANNULER';
        $Multiple_Delete_lng='Suppression multiple';
    }
    elseif($language == 6)
    {
        $home_lng='Начало';
        $Manage_Booking_lng='Поръчки';
        $User_Name_lng='Потребителско име';
        $User_ID_lng='Потребител ID';
        $Booking_ID_lng='Поръчка ID';
        $Taxi_Type_lng='Категория такси';
        $From_lng='От';
        $To_lng='До';
        $Date_lng='Дата';
        $Status_lng='Статус';
        $Action_lng='Действия';
        $single_delete_alert_lng='Сигурни ли сте че искате да изтриете избраната резервацията?';
        $OK_lng='ОК';
        $CANCEL_lng='ОТКАЗ';
        $Multiple_Delete_lng='Изтриване';
    }
}
elseif($urltitle == 'view_booking_details')
{
    if($language == 1)
    {
        $Home_lng='Home';
        $Booking_Details_lng='Booking Details';
        $User_Details_lng='User Details';
        $User_ID_lng='User ID';
        $User_Name_lng='User Name';
        $Booking_ID_lng='Booking ID';
        $Pickup_Area_lng='Pickup Area';
        $Drop_Area_lng='Drop Area';
        $person='No of passengers';
        $adult_13plus='Passengers (13+)';
        $child_13less='Passengers (<13)';
        $child_7less='Passengers (<7)';
        $infant_1less='Passengers (<1)';
        $Booking_Date_Time_lng='Booking Date Time';
        $Pickup_Date_Time_lng='Pickup Date Time';
        $Comment_lng='Comment';
        $Driver_Details_lng='Driver Details';
        $Select_Car_lng='Select Car';
        $Car_Type_lng='Car Type';
        $First_5_km_lng='First 5 Miles';
        $After_5_km_lng='After 5 Miles';
        $Per_Minute_lng	='Per Minute';
        $Approx_Distance_lng='Approx Distance';
        $Approx_Cost_lng='Approx Cost';
        $Approx_Time_lng='Approx Time';
        $km_lng='Miles';
        $min_lng='min';
        $Pickup_Address_lng='Pickup Address';
        $Driver_ID_lng='Driver ID';
        $Enter_pickup_address_lng='Enter pickup address';
        $Driver_Name_lng='Driver Name';
        $Driver_User_Name_lng='Driver User Name';
        $Driver_Email_lng='Driver Email';
        $Ride_Status_lng='Ride Status';
        $Payment_Details_lng='Payment Details';
        $Payment_Type_lng='Payment Type';
        $Transaction_Id_lng='Transaction Id';
        $Driver_Phone_lng='Driver Phone';
        $License_No_lng='License No';
        $Car_No_lng='Car No';
        $Status_lng='Status';
        $Map_lng='Map';
        $SUBMIT_lng='SUBMIT';
        $Final_Amount_lng='Final Amount';
    }
    elseif($language == 2)
    {
        $Home_lng='Zuhause';
        $Booking_Details_lng='Buchungsdetails';
        $User_Details_lng='Nutzerdetails';
        $User_ID_lng='Benutzeridentifikation';
        $User_Name_lng='Benutzername';
        $Booking_ID_lng='Buchungs-ID';
        $Pickup_Areav='Abholbereich';
        $Drop_Area_lng='Drop-Bereich';
        $Booking_Date_Time_lng='Buchungszeitpunkt';
        $Pickup_Date_Time_lng='Datum der Abholung';
        $Comment_lng='Kommentar';
        $Driver_Details_lng='Treiberdetails';
        $Select_Car_lng='Wählen Sie Auto';
        $Car_Type_lng='Auto Typ';
        $First_5_km_lng='Erste 5 Miles';
        $After_5_km_lng='Nach 5 Miles';
        $Per_Minute_lng='Pro Minute';
        $Approx_Distance_lng='Ungefähre Entfernung';
        $Approx_Cost_lng='Ungefähre Kosten';
        $Approx_Time_lng='Ungefähre Zeit';
        $km_lng='Miles';
        $min_lng='Min';
        $Pickup_Address_lng='Abholadresse';
        $Driver_ID_lng='Treiber-ID';
        $Enter_pickup_address_lng='Geben Sie die Abholadresse ein';
        $Driver_Name_lng='Fahrername';
        $Driver_User_Name_lng='Treiberbenutzername';
        $Driver_Email_lng='Treiber Email';
        $Ride_Status_lng='Fahrstatus';
        $Payment_Details_lng='Zahlungsdetails';
        $Payment_Type_lng='Zahlungsart';
        $Transaction_Id_lng='Transaktions-ID';
        $Driver_Phone_lng='Fahrer-Telefon';
        $License_No_lng='Lizenznummer';
        $Car_No_lng='Auto - Nr';
        $Status_lng='Status';
        $Map_lng='Karte';
        $SUBMIT_lng='EINREICHEN';
        $Final_Amount='Endbetrag';
    }
    elseif($language == 3)
    {
        $Home_lng='Casa';
        $Booking_Details_lng='Dettagli della prenotazione';
        $User_Details_lng='Dettagli utente';
        $User_ID_lng='ID utente';
        $User_Name_lng='Nome utente';
        $Booking_ID_lng='Prenotazioni ID';
        $Pickup_Area_lng='Area pickup';
        $Drop_Area_lng='Area di goccia';
        $Booking_Date_Time_lng='Prenotazioni Data Ora';
        $Pickup_Date_Time_lng='Pickup Data Ora';
        $Comment_lng='Commento';
        $Driver_Details_lng='Dettagli del driver';
        $Select_Car_lng='Selezionare auto';
        $Car_Type_lng='Tipo di macchina';
        $First_5_km_lng='Primi 5 Miles';
        $After_5_km_lng='Dopo 5 Miles';
        $Per_Minute_lng='Al minuto';
        $Approx_Distance_lng='circa Distanza';
        $Approx_Cost_lng='Costo approssimativo';
        $Approx_Time_lng='circa Tempo';
        $km_lng='Miles';
        $min_lng='min';
        $Pickup_Address_lng='Indirizzo di ritiro';
        $Driver_ID_lng='driver ID';
        $Enter_pickup_address_lng='Inserisci indirizzo di ritiro';
        $Driver_Name_lng='Nome del driver';
        $Driver_User_Name_lng='Nome del driver utente';
        $Driver_Email_lng='autista-mail';
        $Ride_Status_lng='cavalcata di stato';
        $Payment_Details_lng='Dettagli del pagamento';
        $Payment_Type_lng='Modalità di pagamento';
        $Transaction_Id_lng='ID transazione';
        $Driver_Phone_lng='autista Telefono';
        $License_No_lng='Licenza No';
        $Car_No_lng='auto No';
        $Status_lng='Stato';
        $Map_lng='Carta geografica';
        $SUBMIT_lng='INVIO';
        $Final_Amount='importo finale';
    }
    elseif($language == 4)
    {
        $Home_lng='Главная';
        $Booking_Details_lng='Детали бронирования';
        $User_Details_lng='Сведения о пользователе';
        $User_ID_lng='Идентификатор пользователя';
        $User_Name_lng='имя пользователя';
        $Booking_ID_lng='Бронирование ID';
        $Pickup_Area_lng='Самовывоз Площадь';
        $Drop_Area_lng='Капля Площадь';
        $Booking_Date_Time_lng='Бронирование Дата Время';
        $Pickup_Date_Time_lng='Самовывоз Дата Время';
        $Comment_lng='Комментарий';
        $Driver_Details_lng='Подробнее о драйвере';
        $Select_Car_lng='Выбор автомобиля';
        $Car_Type_lng='Тип автомобиля';
        $First_5_km_lng='Во-первых 5 Miles';
        $After_5_km_lng='Через 5 Miles';
        $Per_Minute_lng='В минуту';
        $Approx_Distance_lng='Приблизительное расстояние';
        $Approx_Cost_lng='Приблизительно Стоимость';
        $Approx_Time_lng='Приблизительное время';
        $km_lng='Miles';
        $min_lng='мин';
        $Pickup_Address_lng='Выберите адрес';
        $Driver_ID_lng='Драйвер ID';
        $Enter_pickup_address_lng='Введите адрес пикап';
        $Driver_Name_lng='Название драйвера';
        $Driver_User_Name_lng='Драйвер Имя пользователя';
        $Driver_Email_lng='Водитель E-mail';
        $Ride_Status_lng='Поездка Статус';
        $Payment_Details_lng='Детали оплаты';
        $Payment_Type_lng='Способ оплаты';
        $Transaction_Id_lng='ID транзакции';
        $Driver_Phone_lng='Драйвер телефона';
        $License_No_lng='Лицензия №';
        $Car_No_lng='Автомобиль Нет';
        $Status_lng='Положение дел';
        $Map_lng='карта';
        $SUBMIT_lng='ОТПРАВИТЬ';
        $Final_Amount_lng='Окончательная сумма';
    }
    elseif($language == 5)
    {
        $Home_lng='Accueil';
        $Booking_Details_lng='Les détails de réservation';
        $User_Details_lng='Détails de l\'utilisateur';
        $User_ID_lng='Identifiant d\'utilisateur';
        $User_Name_lng='Nom d\'utilisateur';
        $Booking_ID_lng='ID de réservation';
        $Pickup_Area_lng='Zone de ramassage';
        $Drop_Area_lng='Zone d\'abandon';
        $Booking_Date_Time_lng='Date de réservation Heure';
        $Pickup_Date_Time_lng='Date de ramassage';
        $Comment_lng='Commentaire';
        $Driver_Details_lng='Détails du pilote';
        $Select_Car_lng='Sélectionner une voiture';
        $Car_Type_lng='Type de voiture';
        $First_5_km_lng='Premiers 5 Miles';
        $After_5_km_lng='Après 5 Miles';
        $Per_Minute_lng='Par minute';
        $Approx_Distance_lng='Distance approximative';
        $Approx_Cost_lng='Coût approximatif';
        $Approx_Time_lng='Durée approximative';
        $km_lng='Miles';
        $min_lng='Min';
        $Pickup_Address_lng='Pickup Adresse';
        $Driver_ID_lng='ID du pilote';
        $Enter_pickup_address='Entrez l\'adresse de ramassage';
        $Driver_Name_lng='Nom du conducteur';
        $Driver_User_Name_lng='Nom d\'utilisateur du pilote';
        $Driver_Email_lng='Courriel du chauffeur';
        $Ride_Status_lng='État de la course';
        $Payment_Details_lng='Détails du paiement';
        $Payment_Type_lng='Type de paiement';
        $Transaction_Id_lng='Identifiant de transaction';
        $Driver_Phone_lng='Téléphone chauffeur';
        $License_No_lng='N ° de licence';
        $Car_No_lng='Voiture Non';
        $Status_lng='statut';
        $Map_lng='Carte';
        $SUBMIT_lng='SOUMETTRE';
        $Final_Amount_lng='Le montant final';
    }
    elseif($language == 6)
    {
        $Home_lng='Начало';
        $Booking_Details_lng='Детайли поръчка';
        $User_Details_lng='Детайли потребител';
        $User_ID_lng='Потребител ID';
        $User_Name_lng='Потребителско име';
        $Booking_ID_lng='Поръчка ID';
        $Pickup_Area_lng='Тръгване';
        $Drop_Area_lng='Пристигане';
        $Booking_Date_Time_lng='Поръчка Дата и Час';
        $Pickup_Date_Time_lng='Тръгване Дата и Час';
        $Comment_lng='Коментар';
        $Driver_Details_lng='Информация за шофьора';
        $Select_Car_lng='Изберете кола';
        $Car_Type_lng='Категория кола';
        $First_5_km_lng='Първите 5 Miles';
        $After_5_km_lng='След 5 Miles';
        $Per_Minute_lng='на минута';
        $Approx_Distance_lng='Приблизително разстояние';
        $Approx_Cost_lng='Приблизителна цена';
        $Approx_Time_lng='Приблизително време';
        $km_lng='Miles';
        $min_lng='мин';
        $Pickup_Address_lng='Адрес на тръгване';
        $Driver_ID_lng='Шофьор ID';
        $Enter_pickup_address_lng='Въведете адрес на тръгванае';
        $Driver_Name_lng='Име на шофьор';
        $Driver_User_Name_lng='Шофьор Потребителско име';
        $Driver_Email_lng='Шофьор Email';
        $Ride_Status_lng='Статус потъчка';
        $Payment_Details_lng='Детайли на плащане';
        $Payment_Type_lng='Вид плащане';
        $Transaction_Id_lng='Номер на транзакцията';
        $Driver_Phone_lng='Телефон на Шофьора';
        $License_No_lng='Лиценз №';
        $Car_No_lng='Кола №';
        $Status_lng='Статус';
        $Map_lng='Карта';
        $SUBMIT_lng='Запази';
        $Final_Amount_lng='Сума';
    }
}
elseif($urltitle == 'manage_driver')
{
    if($language == 1)
    {
        $Manage_Driver_lng='Manage Driver';
        $Home_lng='Home';
        $IMAGE_lng='IMAGE';
        $NAME_lng='NAME';
        $PHONE_NO_lng='PHONE NO';
        $ADDRESS_lng='ADDRESS';
        $LICENSE_NO_lng='LICENSE NO';
        $CAR_TYPE_lng='CAR TYPE';
        $CAR_NO_lng='CAR NO';
        $INSPECTION_lng='Inspection' ;
        $Driver_Status_lng='Driver Status';
        $Status_lng='Status';
        $Action_lng='Action';
        $single_delete_alert_lng='Are you sure you want to delete the selected user?';
        $OK_lng='OK';
        $CANCEL_lng='CANCEL';
        $Multiple_Delete_lng='Multiple Delete';
    }
    elseif($language == 2)
    {
        $Manage_Driver_lng='Treiber verwalten';
        $Home_lng='Zuhause';
        $IMAGE_lng='IMAGE';
        $NAME_lng='NAME';
        $PHONE_NO_lng='TELEFON-NR';
        $ADDRESS_lng='ADRESSE';
        $LICENSE_NO_lng='LIZENZNUMMER';
        $CAR_TYPE_lng='AUTO TYP';
        $CAR_NO_lng='AUTO NO';
        $Driver_Status_lng='Treiberstatus';
        $Status_lng='Status';
        $Action_lng='Aktion';
        $single_delete_alert_lng='Möchten Sie den ausgewählten Benutzer wirklich löschen?';
        $OK_lng='OK';
        $CANCEL_lng='STORNIEREN';
        $Multiple_Delete_lng='Mehrfach löschen';
    }
    elseif($language == 3)
    {
        $Manage_Driver_lng='gestire driver';
        $Home_lng='Casa';
        $IMAGE_lng='IMMAGINE';
        $NAME_lng='NOME';
        $PHONE_NO_lng='TELEFONO NO';
        $ADDRESS_lng='INDIRIZZO';
        $LICENSE_NO_lng='LICENZA NO';
        $CAR_TYPE_lng='TIPO DI MACCHINA';
        $CAR_NO_lng='AUTO NO';
        $Driver_Status_lng='stato del driver';
        $Status_lng='Stato';
        $Action_lng='Azione';
        $single_delete_alert_lng='Sei sicuro di voler eliminare l\'utente selezionato?';
        $OK_lng='ok';
        $CANCEL_lng='ANNULLA';
        $Multiple_Delete_lng='Elimina multipla';
    }
    elseif($language == 4)
    {
        $Manage_Driver_lng='Управление драйвера';
        $Home_lng='Главная';
        $IMAGE_lng='ОБРАЗ';
        $NAME_lng='ИМЯ';
        $PHONE_NO_lng='НОМЕР ТЕЛЕФОНА';
        $ADDRESS_lng='АДРЕС';
        $LICENSE_NO_lng='ЛИЦЕНЗИЯ №';
        $CAR_TYPE_lng='ТИП АВТОМОБИЛЯ';
        $CAR_NO_lng='CAR NO';
        $Driver_Status_lng='Состояние водителя';
        $Status_lng='Положение дел';
        $Action_lng='действие';
        $single_delete_alert_lng='Вы уверены, что хотите удалить выбранного пользователя?';
        $OK_lng='ОК';
        $CANCEL_lng='ОТМЕНА';
        $Multiple_Delete_lng='Удалить несколько';
    }
    elseif($language == 5)
    {
        $Manage_Driver_lng='Gérer le pilote';
        $Home_lng='Accueil';
        $IMAGE_lng='IMAGE';
        $NAME_lng='PRÉNOM';
        $PHONE_NO_lng='PAS DE TÉLÉPHONE';
        $ADDRESS_lng='ADRESSE';
        $LICENSE_NO_lng='N ° DE LICENCE';
        $CAR_TYPE_lng='TYPE DE VOITURE';
        $CAR_NO_lng='VOITURE NON';
        $Driver_Status_lng='Statut du pilote';
        $Status_lng='statut';
        $Action_lng='action';
        $single_delete_alert_lng='Voulez-vous vraiment supprimer l\'utilisateur sélectionné?';
        $OK_lng='D\'accord';
        $CANCEL_lng='ANNULER';
        $Multiple_Delete_lng='Suppression multiple';
    }
    elseif($language == 6)
    {
        $Manage_Driver_lng='Шофьори';
        $Home_lng='Начало';
        $IMAGE_lng='ИЗОБРАЖЕНИЕ';
        $NAME_lng='ИМЕ';
        $PHONE_NO_lng='ТЕЛЕФОН';
        $ADDRESS_lng='АДРЕС';
        $LICENSE_NO_lng='ЛИЦЕНЗ №';
        $CAR_TYPE_lng='КАТЕГОРИЯ';
        $CAR_NO_lng='КОЛА №';
        $Driver_Status_lng='Статус шофьор';
        $Status_lng='Статус';
        $Action_lng='Действия';
        $single_delete_alert_lng='Сигурни ли сте, че искате да изтриете избрания потребител?';
        $OK_lng='ОК';
        $CANCEL_lng='ОТКАЗ';
        $Multiple_Delete_lng='Изтриване';
    }
}
elseif($urltitle == 'manage_cashout')
{
    if($language == 1)
    {
        $Manage_Cashout_lng='Manage Cashout';
        $Home_lng='Home';
        $Driver_id_lng='DRIVER ID';
        $Description_lng='DESCRIPTION';
        $Request_date_lng='REQUEST DATE';
        $Payment_date_lng='PAYMENT DATE';
        $Action_lng='Action';
        $Request_flag_lng = 'Status';
        $single_delete_alert_lng='Are you sure you want to delete the selected entry?';
        $OK_lng='OK';
        $CANCEL_lng='CANCEL';
        $Multiple_Delete_lng='Multiple Delete';
    }
}
elseif($urltitle == 'view_driver_details')
{
    if($language == 1)
    {
        $Driver_Details_lng='Driver Details';
        $HOME_lng='HOME';
        $profile_picture_lng='Profile Picture';
        $driver_license_front_picture_lng='Driver License Front';
        $driver_license_back_picture_lng='Driver License Back';
        $driver_vehicle_registration_img_lng = 'Driver Vechile Registration';
        $Name_lng='Name';
        $Username_lng='Username';
        $Email_lng='Email';
        $Gender_lng='Gender';
        $Date_Of_Birth_lng='Date Of Birth';
        $Address_lng='Address';
        $Phone_NO_lng='Phone NO';
        $Email_Address_lng='Email Address';
        $License_NO_lng='License NO';
        $License_Expiry_Date_lng='License Expiry Date';
        $License_Plate_lng='License Plate';
        $Insurance_lng='Insurance';
        $Change_Password_lng='Change Password';
        $Car_Type_lng='Car Type';
        $Car_Details_lng='Car Details';
        $Inspection_Record_Details_lng='Inspection Record';
        $Inspection_Appointment_Details_lng='Inspection Appointment';
        $Inspection_Date = 'Date';
        $Inspection_Time = 'Time';
        $Inspection_lng = 'Inspect';
        $Inspection_Inspector = 'Inspector';
        $Inspection_Result = 'Result';
        $Inspection_Location = 'Location';
        $Inspection_Action = 'Action';
        $Car_No_lng='Car No';
        $Car_Model_lng='Car Model';
        $Car_Make_lng='Car Make';
        $Loading_Capacity_lng='Loading Capacity';
        $is_featured_lng = 'Is Featured?';
        $Payment_Details_lng='Payment Details';
        $Payment_by_Cash_lng='Payment by Cash';
        $Payment_by_Card_lng='Payment by Card';
        $Total_Payment_lng='Total Payment';
        $Current_Balance_lng='Current Balance';
        $Payment_Made_lng='Payment Made';
        $Data_Filter_lng='Data Filter';
        $Start_Date_lng='Start Date';
        $End_Date_lng='End Date';
        $Driver_Earnings_lng='Driver Earnings';
        $Transaction_History_lng='Transaction History';
        $Booking_ID_lng='Booking ID';
        $Pickup_Location_lng='Pickup Location';
        $Drop_Location_lng='Drop Location';
        $Pickup_Date_Time_lng='Pickup Date/Time';
        $Payment_Type_lng='Payment Type';
        $Driver_Commision_lng='Driver Commision';
        $Website_Commision_lng='Website Commision';
        $Make_Payment_lng='Make Payment';
        $Add_New_Transaction_lng='Add New Transaction';
        $Driver_ID_lng='Driver ID';
        $Driver_Name_lng='Driver Name';
        $Payment_Mode_lng='Payment Mode';
        $Select_Payment_Type_lng='Select Payment Type';
        $Cash_lng='Cash';
        $Card_Net_Banking_lng='Card/Net Banking';
        $Bank_Transfer_lng='Bank Transfer';
        $Payment_Date_lng='Payment Date';
        $Amount_lng='Amount';
        $Description_lng='Description';
        $Comment_lng='Comment';
        $Close_lng='Close';
        $Save_changes_lng='Save changes';
        $Transaction_Id_lng='Transaction Id';
    }
    elseif($language == 2)
    {
        $Driver_Details_lng='Treiberdetails';
        $HOME_lng='ZUHAUSE';
        $profile_picture_lng='Profilbild';
        $Name_lng='Name';
        $Username_lng='Benutzername';
        $Email_lng='Email';
        $Gender_lng='Geschlecht';
        $Date_Of_Birth_lng='Geburtsdatum';
        $Address_lng='Adresse';
        $Phone_NO_lng='Telefon-Nr';
        $Email_Address_lng='E-Mail-Addresse';
        $License_NO_lng='Lizenznummer';
        $License_Expiry_Date_lng='Lizenzlaufzeit';
        $License_Plate_lng='Nummernschild';
        $Insurance_lng='Versicherung';
        $Change_Password_lng='Passwort ändern';
        $Car_Type_lng='Auto Typ';
        $Car_Details_lng='Fahrzeugdetails';
        $Car_No_lng='Auto - Nr';
        $Car_Model_lng='Auto Model';
        $Car_Make_lng='Auto machen';
        $Loading_Capacity_lng='Tragfähigkeit';
        $Payment_Details_lng='Zahlungsdetails';
        $Payment_by_Cash_lng='Zahlung per Nachnahme';
        $Payment_by_Card_lng='Zahlung per Karte';
        $Total_Payment_lng='Gesamtzahlung';
        $Current_Balance_lng='Aktueller Saldo';
        $Payment_Made_lng='Zahlung erfolgt';
        $Data_Filter_lng='Datenfilter';
        $Start_Date_lng='Anfangsdatum';
        $End_Date_lng='Enddatum';
        $Driver_Earnings_lng='Fahrereinnahmen';
        $Transaction_History_lng='Verlauf der Transaktionen';
        $Booking_ID_lng='Buchungs-ID';
        $Pickup_Location_lng='Treffpunkt';
        $Drop_Location_lng='Drop-Standort';
        $Pickup_Date_Time_lng='Abholdatum / Uhrzeit';
        $Payment_Type_lng='Zahlungsart';
        $Driver_Commision_lng='Fahrer-Kommission';
        $Website_Commision_lng='Website-Kommission';
        $Make_Payment_lng='Zahlung leisten';
        $Add_New_Transaction_lng='Neue Transaktion hinzufügen';
        $Driver_ID_lng='Treiber-ID';
        $Driver_Name_lng='Fahrername';
        $Payment_Mode_lng='Zahlungsart';
        $Select_Payment_Type_lng='Wählen Sie Zahlungsart';
        $Cash_lng='Kasse';
        $Card_Net_Banking_lng='Karten / Net Banking';
        $Bank_Transfer_lng='Banküberweisung';
        $Payment_Date_lng='Zahlungsdatum';
        $Amount_lng='Menge';
        $Description_lng='Beschreibung';
        $Comment_lng='Kommentar';
        $Close_lng='Schließen';
        $Save_changes_lng='Änderungen speichern';
        $Transaction_Id_lng='Transaktions-ID';
    }
    elseif($language == 3)
    {
        $Driver_Details_lng='Dettagli del driver';
        $HOME_lng='CASA';
        $profile_picture_lng='immagine del profilo';
        $Name_lng='Nome';
        $Usernamev='Nome utente';
        $Email_lng='E-mail';
        $Gender_lng='Genere';
        $Date_Of_Birth_lng='Data di nascita';
        $Address_lng='Indirizzo';
        $Phone_NO_lng='NO Telefono';
        $Email_Address_lng='Indirizzo email';
        $License_NO_lng='nessuna licenza';
        $License_Expiry_Date_lng='Licenza Data di scadenza';
        $License_Plate_lng='Targa';
        $Insurance_lng='Assicurazione';
        $Change_Password_lng='Cambia la password';
        $Car_Type_lng='Tipo di macchina';
        $Car_Details_lng='Dettagli Car';
        $Car_No_lng='auto No';
        $Car_Model_lng='Modello d\'auto';
        $Car_Make_lng='L\'automobile fa';
        $Loading_Capacity_lng='Capacità di carico';
        $Payment_Details_lng='Dettagli del pagamento';
        $Payment_by_Cash_lng='Pagamento in contanti';
        $Payment_by_Card_lng='Pagamento con Carta';
        $Total_Payment_lng='Pagamento totale';
        $Current_Balance_lng='Bilancio corrente';
        $Payment_Made_lng='Pagamento fatto';
        $Data_Filter_lng='Filtro dei dati';
        $Start_Date_lng='Data d\'inizio';
        $End_Date_lng='Data di fine';
        $Driver_Earnings_lng='Guadagni driver';
        $Transaction_History_lng='Cronologia delle transazioni';
        $Booking_ID_lng='Prenotazioni ID';
        $Pickup_Location_lng='Posto di raccolta';
        $Drop_Location_lng='goccia Località';
        $Pickup_Date_Time_lng='Pickup Data / ora';
        $Payment_Type_lng='Modalità di pagamento';
        $Driver_Commision_lng='Commision driver';
        $Website_Commision_lng='Sito Commision';
        $Make_Payment_lng='Fare un pagamento';
        $Add_New_Transaction_lng='Aggiungere nuova transazione';
        $Driver_ID_lng='driver ID';
        $Driver_Name_lng='Nome del driver';
        $Payment_Mode_lng='Metodo di pagamento';
        $Select_Payment_Type_lng='Selezionare il tipo di pagamento';
        $Cash_lng='Contanti';
        $Card_Net_Banking_lng='Scheda / Net Banking';
        $Bank_Transfer_lng='Trasferimento bancario';
        $Payment_Date_lng='Data di pagamento';
        $Amount_lng='Quantità';
        $Description_lng='Descrizione';
        $Comment_lng='Commento';
        $Close_lng='Vicino';
        $Save_changes_lng='Salva I Cambiamenti';
        $Transaction_Id_lng='ID transazione';
    }
    elseif($language == 4)
    {
        $Driver_Details_lng='Подробнее о драйвере';
        $HOME_lng='ГЛАВНАЯ';
        $profile_picture_lng='изображение профиля';
        $Name_lng='имя';
        $Username_lng='Имя пользователя';
        $Email_lng='Эл. адрес';
        $Gender_lng='Пол';
        $Date_Of_Birth_lng='Дата рождения';
        $Address_lng='Адрес';
        $Phone_NO_lng='Номер телефона';
        $Email_Address_lng='Адрес электронной почты';
        $License_NO_lng='Лицензия №';
        $License_Expiry_Date_lng='Срок окончания действия лицензии';
        $License_Plate_lng='Номерной знак';
        $Insurance_lng='страхование';
        $Change_Password_lng='Изменить пароль';
        $Car_Type_lng='Тип автомобиля';
        $Car_Details_lng='Автомобильные детали';
        $Car_No_lng='Автомобиль Нет';
        $Car_Model_lng='Модель автомобиля';
        $Car_Make_lng='Автомобиль делает';
        $Loading_Capacity_lng='Объем загрузки';
        $Payment_Details_lng='Детали оплаты';
        $Payment_by_Cash_lng='Платеж наличными';
        $Payment_by_Card_lng='Оплата карточкой';
        $Total_Payment_lng='Всего к оплате';
        $Current_Balance_lng='Текущий баланс';
        $Payment_Made_lng='Платеж произведен';
        $Data_Filter_lng='Фильтр данных';
        $Start_Date_lng='Дата начала';
        $End_Date_lng='Дата окончания';
        $Driver_Earnings_lng='Заработок водителя';
        $Transaction_History_lng='История транзакций';
        $Booking_ID_lng='Бронирование ID';
        $Pickup_Location_lng='Выбрать место';
        $Drop_Location_lng='Капля Расположение';
        $Pickup_Date_Time_lng='Самовывоз Дата / время';
        $Payment_Type_lng='Способ оплаты';
        $Driver_Commision_lng='Commision Driver';
        $Website_Commision_lng='Commision Веб-сайт';
        $Make_Payment_lng='Производить оплату';
        $Add_New_Transaction_lng='Добавить новую транзакцию';
        $Driver_ID_lng='Драйвер ID';
        $Driver_Name_lng='Название драйвера';
        $Payment_Mode_lng='Режим оплаты';
        $Select_Payment_Type_lng='Выберите тип оплаты';
        $Cash_lng='Денежные средства';
        $Card_Net_Banking_lng='Card / Net Banking';
        $Bank_Transfer_lng='Банковский перевод';
        $Payment_Date_lng='Дата платежа';
        $Amount_lng='Количество';
        $Description_lng='Описание';
        $Comment_lng='Комментарий';
        $Close_lng='Закрыть';
        $Save_changes_lng='Сохранить изменения';
        $Transaction_Id_lng='ID транзакции';
    }
    elseif($language == 5)
    {
        $Driver_Details_lng='Détails du pilote';
        $HOME_lng='DOMICILE';
        $profile_picture_lng='image de profil';
        $Name_lng='prénom';
        $Username_lng='Nom d\'utilisateur';
        $Email_lng='Email';
        $Gender_lng='Le genre';
        $Date_Of_Birth_lng='Date de naissance';
        $Address_lng='Adresse';
        $Phone_NO_lng='Pas de téléphone';
        $Email_Address_lng='Adresse e-mail';
        $License_NO_lng='N ° de licence';
        $License_Expiry_Date_lng='Date d\'expiration de la licence';
        $License_Plate_lng='Plaque d\'immatriculation';
        $Insurance_lng='Assurance';
        $Change_Password_lng='Changer le mot de passe';
        $Car_Type_lng='Type de voiture';
        $Car_Details_lng='Détails de la voiture';
        $Car_No_lng='Voiture Non';
        $Car_Model_lng='Modèle de voiture';
        $Car_Make_lng='Marque de voiture';
        $Loading_Capacity_lng='Capacité de chargement';
        $Payment_Details_lng='Détails du paiement';
        $Payment_by_Cash_lng='Paiement par espèces';
        $Payment_by_Card_lng='Paiement par carte';
        $Total_Payment_lng='Paiement total';
        $Current_Balance_lng='Solde actuel';
        $Payment_Made_lng='Paiement effectué';
        $Data_Filter_lng='Filtre de données';
        $Start_Date_lng='Date de début';
        $End_Date_lng='Date de fin';
        $Driver_Earnings_lng='Gains des conducteurs';
        $Transaction_History_lng='Historique des transactions';
        $Booking_ID_lng='ID de réservation';
        $Pickup_Location_lng='Lieu de ramassage';
        $Drop_Location_lng='Lieu de dépôt';
        $Pickup_Date_Time_lng='Date et heure de ramassage';
        $Payment_Type_lng='Type de paiement';
        $Driver_Commision_lng='Commande de pilote';
        $Website_Commision_lng='Site Web Commision';
        $Make_Payment_lng='Effectuer le paiement';
        $Add_New_Transaction_lng='Ajouter une nouvelle transaction';
        $Driver_ID_lng='ID du pilote';
        $Driver_Name_lng='Nom du conducteur';
        $Payment_Mode_lng='Mode de paiement';
        $Select_Payment_Type_lng='Sélectionnez le type de paiement';
        $Cash_lng='Argent liquide';
        $Card_Net_Banking_lng='Carte / Banque Net';
        $Bank_Transfer_lng='Virement';
        $Payment_Date_lng='Date de paiement';
        $Amount_lng='Montant';
        $Description_lng='La description';
        $Comment_lng='Commentaire';
        $Close_lng='Fermer';
        $Save_changes_lng='Sauvegarder les modifications';
        $Transaction_Id_lng='Identifiant de transaction';
    }
    elseif($language == 6)
    {
        $Driver_Details_lng='Детайли шофьор';
        $HOME_lng='Начало';
        $profile_picture_lng='Снимка на профила';
        $Name_lng='Име';
        $Username_lng='Потребителско име';
        $Email_lng='Email';
        $Gender_lng='Пол';
        $Date_Of_Birth_lng='Дата на раждане';
        $Address_lng='Адрес';
        $Phone_NO_lng='Телефон';
        $Email_Address_lng='Email';
        $License_NO_lng='Лиценз №';
        $License_Expiry_Date_lng='Срок на годност на Лиценз';
        $License_Plate_lng='Регистрационен номер';
        $Insurance_lng='Застраховка';
        $Change_Password_lng='Смяна на парола';
        $Car_Type_lng='Категория кола';
        $Car_Details_lng='Детайли за кола';
        $Car_No_lng='Кола №';
        $Car_Model_lng='Модел кола';
        $Car_Make_lng='Марка кола';
        $Loading_Capacity_lng='Товароподемност';
        $Payment_Details_lng='Детайли на плащане';
        $Payment_by_Cash_lng='Плащане в брой';
        $Payment_by_Card_lng='Плащане с карта';
        $Total_Payment_lng='Общо';
        $Current_Balance_lng='Текущ баланс';
        $Payment_Made_lng='Извършено плащане';
        $Data_Filter_lng='Филтър';
        $Start_Date_lng='Начална дата';
        $End_Date_lng='Крайна дата';
        $Driver_Earnings_lng='Печалба на водача';
        $Transaction_History_lng='История на транзакция';
        $Booking_ID_lng='Поръчка ID';
        $Pickup_Location_lng='Тръгване';
        $Drop_Location_lng='Пристигане';
        $Pickup_Date_Time_lng='Тръгване Дата и Час';
        $Payment_Type_lng='Вид плащане';
        $Driver_Commision_lng='Комисионна шофьор';
        $Website_Commision_lng='Комисионна сайт';
        $Make_Payment_lng='Извършено плащане';
        $Add_New_Transaction_lng='Добави нова транзакция';
        $Driver_ID_lng='Шофьор ID';
        $Driver_Name_lng='Име шофьор';
        $Payment_Mode_lng='Начин на плащане';
        $Select_Payment_Type_lng='Изберете начин на плащане';
        $Cash_lng='В брой';
        $Card_Net_Banking_lng='Карта';
        $Bank_Transfer_lng='Банков трансфер';
        $Payment_Date_lng='Дата на плащане';
        $Amount_lng='Количество';
        $Description_lng='Описание';
        $Comment_lng='Коментар';
        $Close_lng='Затвори';
        $Save_changes_lng='Запази промените';
        $Transaction_Id_lng='Номер на транзакцията';
    }
}
elseif($urltitle == 'view_cashout_details')
{
    if($language == 1)
    {
        $Cashout_lng ='Cashout';
        $HOME_lng='HOME';
        $Driver_Id_lng='Driver ID';
        $Enter_Driver_Id_lng = 'Enter Driver Id';
        $Description_lng = 'Description';
        $Enter_Description_lng = 'Enter Description';
        $RequestDate_lng = 'Request Date';
        $PaymentDate_lng = 'Payment Date';
        $Enter_RequestDate_lng = 'Enter Request Date';
        $Enter_PaymentDate_lng = 'Enter Payment Date';
        $SUBMIT_lng='SUBMIT';
    }
}
elseif($urltitle == 'driver_change_password')
{
    if($language == 1)
    {
        $home_lng='HOME';
        $Change_Password_lng='Change Password';
        $New_Password_lng='New Password';
        $Enter_New_Password_lng='Enter New Password';
        $Enter_Confirm_Password_lng='Enter Confirm Password';
        $Confirm_Password_lng='Confirm Password';
        $SUBMIT_lng='SUBMIT';
    }
    elseif($language == 2)
    {
        $home_lng='ZUHAUSE';
        $Change_Password_lng='Passwort ändern';
        $New_Password_lng='Neues Kennwort';
        $Enter_New_Password_lng='Neues Passwort eingeben';
        $Enter_Confirm_Password_lng='Geben Sie Kennwort bestätigen ein';
        $Confirm_Password_lng='Bestätige das Passwort';
        $SUBMIT_lng='EINREICHEN';
    }
    elseif($language == 3)
    {
        $home_lng='CASA';
        $Change_Password_lng='Cambia la password';
        $New_Password_lng='nuova password';
        $Enter_New_Password_lng='Inserire una nuova password';
        $Enter_Confirm_Password_lng='Invio Conferma password';
        $Confirm_Password_lng='conferma password';
        $SUBMIT_lng='INVIO';
    }
    elseif($language == 4)
    {
        $home_lng='ГЛАВНАЯ';
        $Change_Password_lng='Изменить пароль';
        $New_Password_lng='новый пароль';
        $Enter_New_Password_lng='Введите новый пароль';
        $Enter_Confirm_Password_lng='Enter Подтверждение пароля';
        $Confirm_Password_lng='Подтвердите Пароль';
        $SUBMIT_lng='ОТПРАВИТЬ';
    }
    elseif($language == 5)
    {
        $home_lng='DOMICILE';
        $Change_Password_lng='Changer le mot de passe';
        $New_Password_lng='nouveau mot de passe';
        $Enter_New_Password_lng='Entrez un nouveau mot de passe';
        $Enter_Confirm_Password_lng='Entrer Confirmer mot de passe';
        $Confirm_Password_lng='Confirmez le mot de passe';
        $SUBMIT_lng='SOUMETTRE';
    }
    elseif($language == 6)
    {
        $home_lng='Начало';
        $Change_Password_lng='Смяна на парола';
        $New_Password_lng='Нова парола';
        $Enter_New_Password_lng='Въведете новата парола';
        $Enter_Confirm_Password_lng='Потвърдете парола';
        $Confirm_Password_lng='Потвърди парола';
        $SUBMIT_lng='Запази';
    }
}
elseif($urltitle == 'manage_car_type')
{
    if($language == 1)
    {
        $Manage_Car_Type_lng ='Manage Car Type';
        $HOME_lng='HOME';
        $Add_Car_Type_lng='Add Car Type';
        $CAR_ICON_lng='CAR ICON';
        $CAR_TYPE_lng='CAR TYPE';
        $CAR_RATE_lng='CAR RATE';
        $LOADING_CAPACITY_lng='LOADING CAPACITY';
        $Action_lng='Action';
        $single_delete_alert_lng='Are you sure you want to delete the selected user?';
        $OK_lng='OK';
        $CANCEL_lng='CANCEL';
        $Multiple_Delete_lng='Multiple Delete';
    }
    elseif($language == 2)
    {
        $Manage_Car_Type_lng='Verwalten Sie Auto-Typ';
        $HOME_lng='ZUHAUSE';
        $Add_Car_Type_lng='Auto hinzufügen';
        $CAR_ICON_lng='AUTO IKONE';
        $CAR_TYPE_lng='AUTO TYP';
        $CAR_RATE_lng='AUTO-RATE';
        $LOADING_CAPACITY_lng='LADEKAPAZITÄT';
        $Action_lng='Aktion';
        $single_delete_alert_lng='Möchten Sie den ausgewählten Benutzer wirklich löschen?';
        $OK_lng='OK';
        $CANCEL_lng='STORNIEREN';
        $Multiple_Delete_lng='Mehrfach löschen';
    }
    elseif($language == 3)
    {
        $Manage_Car_Type_lng='Gestire Tipo auto';
        $HOME_lng='CASA';
        $Add_Car_Type_lng='Aggiungi tipo di auto';
        $CAR_ICON_lng='CAR ICON';
        $CAR_TYPE_lng='TIPO DI MACCHINA';
        $CAR_RATE_lng='CAR RATE';
        $LOADING_CAPACITY_lng='CAPACITÀ DI CARICO';
        $Action_lng='Azione';
        $single_delete_alert_lng='Sei sicuro di voler eliminare l\'utente selezionato?';
        $OK_lng='ok';
        $CANCEL_lng='ANNULLA';
        $Multiple_Delete_lng='Elimina multipla';
    }
    elseif($language == 4)
    {
        $Manage_Car_Type_lng='Управление Тип автомобиля';
        $HOME_lng='ГЛАВНАЯ';
        $Add_Car_Type_lng='Добавить тип автомобиля';
        $CAR_ICON_lng='CAR ICON';
        $CAR_TYPE_lng='ТИП АВТОМОБИЛЯ';
        $CAR_RATE_lng='СКОРОСТЬ АВТОМОБИЛЯ';
        $LOADING_CAPACITY_lng='нагрузочную способность';
        $Action_lng='действие';
        $single_delete_alert_lng='Вы уверены, что хотите удалить выбранного пользователя?';
        $OK_lng='ОК';
        $CANCEL_lng='ОТМЕНА';
        $Multiple_Delete_lng='Удалить несколько';
    }
    elseif($language == 5)
    {
        $Manage_Car_Type_lng='Gérer le type de voiture';
        $HOME_lng='DOMICILE';
        $Add_Car_Type_lng='Ajouter un type de voiture';
        $CAR_ICON_lng='CAR ICON';
        $CAR_TYPE_lng='TYPE DE VOITURE';
        $CAR_RATE_lng='TAUX DE LA VOITURE';
        $LOADING_CAPACITY_lng='CAPACITÉ DE CHARGEMENT';
        $Action_lng='action';
        $single_delete_alert_lng='Voulez-vous vraiment supprimer l\'utilisateur sélectionné?';
        $OK_lng='D\'accord';
        $CANCEL_lng='ANNULER';
        $Multiple_Delete_lng='Suppression multiple';
    }
    elseif($language == 6)
    {
        $Manage_Car_Type_lng='Категория кола';
        $HOME_lng='Начало';
        $Add_Car_Type_lng='Добави категория кола';
        $CAR_ICON_lng='Иконка';
        $CAR_TYPE_lng='Категория';
        $CAR_RATE_lng='Цена';
        $LOADING_CAPACITY_lng='Товароподемност';
        $Action_lng='Действия';
        $single_delete_alert_lng='Сигурни ли сте, че искате да изтриете избраната категория?';
        $OK_lng='ОК';
        $CANCEL_lng='ОТКАЗ';
        $Multiple_Delete_lng='Изтриване';
    }
}
elseif($urltitle == 'view_cartype_details')
{
    if($language == 1)
    {
        $Add_Car_Type_lng ='Add Car Type';
        $HOME_lng='HOME';
        $Car_Image_lng='Car Image';
        $Car_Type_lng='Car Type';
        $Enter_Car_Types_lng='Enter Car Types';
        $Car_Types_Arabic_lng='Car Types Arabic';
        $Enter_Car_Types_Arabic_lng='Enter Car Types Arabic';
        $Transfer_Type_lng='Transfer Type';
        $Enter_Transfer_Types_lng='Enter Transfer Types';
        $Transfer_Types_Arabic_lng='Transfer Types Arabic';
        $Enter_Transfer_Types_Arabic_lng='Enter Transfer Types Arabic';
        $Initial_KM_lng='Initial Miles';
        $Car_Rate_lng='Car Rate';
        $Enter_car_rate_lng='Enter car rate';
        $Night_Initial_Rate_lng='Night Initial Rate';
        $Enter_Night_Initial_Rate_lng='Enter Night Initial Rate';
        $From_Initial_Rate_lng='From Initial Rate';
        $Enter_From_Initial_KM_lng='Enter From Initial KM';
        $Night_From_Initial_Rate_lng='Night From Initial Rate';
        $Enter_From_Initial_Rate_lng='Enter From Initial Rate';
        $Ride_Time_Rate_lng='Ride Time Rate';
        $Enter_Ride_From_Time_Rate_lng='Enter Ride From Time Rate';
        $Night_Ride_Time_Rate_lng='Night Ride Time Rate';
        $Enter_Night_Ride_From_Time_Rate_lng='Enter Night Ride From Time Rate';
        $Time_Type_lng='Time Type';
        $Enter_Time_Type_lng='Enter Time Type';
        $Description_lng='Description';
        $Enter_Description_lng='Enter Description';
        $Description_Arabic_lng='Description Arabic';
        $Loading_Capacity_lng='Loading Capacity';
        $SUBMIT_lng='SUBMIT';
    }
    elseif($language == 2)
    {
        $Add_Car_Type_lng='Auto hinzufügen';
        $HOME_lng='ZUHAUSE';
        $Car_Image_lng='Auto-Bild';
        $Car_Type_lng='Auto Typ';
        $Car_Types_Arabic_lng='Autotypen Arabisch';
        $Enter_Car_Types_lng='Geben Sie Fahrzeugtypen ein';
        $Enter_Car_Types_Arabic_lng='Geben Sie Autotypen Arabisch';
        $Transfer_Type_lng='Transfer-Typ';
        $Enter_Transfer_Types_lng='Geben Sie Übertragungsarten';
        $Transfer_Types_Arabic_lng='Transfertypen Arabisch';
        $Enter_Transfer_Types_Arabic_lng='Geben Sie Transfertypen Arabisch';
        $Initial_KM_lng='Erste Miles';
        $Car_Rate_lng='Autotarif';
        $Enter_car_rate_lng='Geben Sie Autotarif ein';
        $Night_Initial_Rate_lng='Nacht Initial Rate';
        $Enter_Night_Initial_Rate_lng='Geben Sie die Nacht-Initialrate ein';
        $From_Initial_Rate_lng='Von der Anfangsrate';
        $Enter_From_Initial_KM_lng='Von Anfangs-KM eingeben';
        $Night_From_Initial_Rate_lng='Nacht ab Anfangsrate';
        $Enter_From_Initial_Rate_lng='Geben Sie von der Anfangsrate ein';
        $Ride_Time_Rate_lng='Fahrzeit';
        $Enter_Ride_From_Time_Rate_lng='Geben Sie Ride From Time Rate ein';
        $Night_Ride_Time_Rate_lng='Nachtfahrtzeit';
        $Enter_Night_Ride_From_Time_Rate_lng='Geben Sie die Nachtfahrt von der Zeitrate ein';
        $Time_Type_lng='Zeittyp';
        $Enter_Time_Type_lng='Geben Sie Uhrzeitart ein';
        $Description_lng='Beschreibung';
        $Enter_Description_lng='Geben Sie Beschreibung ein';
        $Description_Arabic_lng='Beschreibung Arabic';
        $Loading_Capacity_lng='Tragfähigkeit';
        $SUBMIT_lng='EINREICHEN';
    }
    elseif($language == 3)
    {
        $Add_Car_Type_lng='Aggiungi tipo di auto';
        $HOME_lng='CASA';
        $Car_Image_lng='Car Immagine';
        $Car_Type_lng='Tipo di macchina';
        $Car_Types_Arabic_lng='Tipi di auto arabo';
        $Enter_Car_Types_lng='Намудҳои мошини ворид кунед';
        $Enter_Car_Types_Arabic_lng='Inserisci Tipi auto arabi';
        $Transfer_Type_lng='Tipo di trasferimento';
        $Enter_Transfer_Types_lng='Inserisci Tipi di trasferimento';
        $Transfer_Types_Arabic_lng='Tipi di trasferimento arabo';
        $Enter_Transfer_Types_Arabic_lng='Inserisci Tipi di trasferimento arabi';
        $Initial_KM_lng='KM iniziale';
        $Car_Rate_lng='auto Tasso';
        $Enter_car_rate_lng='Inserisci tasso di noleggio';
        $Night_Initial_Rate_lng='Notte tasso iniziale';
        $Enter_Night_Initial_Rate_lng='Inserisci Notte tasso iniziale';
        $From_Initial_Rate_lng='Dal tasso iniziale';
        $Enter_From_Initial_KM_lng='Inserisci Da KM iniziale';
        $Night_From_Initial_Rate_lng='Notte da Tasso iniziale';
        $Enter_From_Initial_Rate_lng='Inserisci Da tasso iniziale';
        $Ride_Time_Rate_lng='Giro Time Rate';
        $Enter_Ride_From_Time_Rate_lng='Inserisci Ride Da Time Rate';
        $Night_Ride_Time_Rate_lng='Night Ride Time Rate';
        $Enter_Night_Ride_From_Time_Rate_lng='Inserisci Night Ride Da Time Rate';
        $Time_Type_lng='Tipo tempo';
        $Enter_Time_Type_lng='Inserisci Ora Tipo';
        $Description_lng='Descrizione';
        $Enter_Description_lng='Inserisci Descrizione';
        $Description_Arabic_lng='Descrizione arabo';
        $Loading_Capacity_lng='Capacità di carico';
        $SUBMIT_lng='INVIO';
    }
    elseif($language == 4)
    {
        $Add_Car_Type_lng='Добавить тип автомобиля';
        $HOME_lng='ГЛАВНАЯ';
        $Car_Image_lng='Автомобиль изображение';
        $Car_Type_lng='Тип автомобиля';
        $Car_Types_Arabic_lng='Типы автомобилей арабский';
        $Enter_Car_Types_lng='Введите типы автомобилей';
        $Enter_Car_Types_Arabic_lng='Введите автомобилей Типы арабский';
        $Transfer_Type_lng='Тип передачи';
        $Enter_Transfer_Types_lng='Введите типы передачи';
        $Transfer_Types_Arabic_lng='Типы передачи арабский';
        $Enter_Transfer_Types_Arabic_lng='Введите типы передачи арабский';
        $Initial_KM_lng='Первоначальная KM';
        $Car_Rate_lng='Автомобиль Оценить';
        $Enter_car_rate_lng='Введите скорость автомобиля';
        $Night_Initial_Rate_lng='Ночь начальная скорость';
        $Enter_Night_Initial_Rate_lng='Введите Night начальная скорость';
        $From_Initial_Rate_lng='От начальной скорости';
        $Enter_From_Initial_KM_lng='Введите от первоначального KM';
        $Night_From_Initial_Rate_lng='Ночь от начальной скорости';
        $Enter_From_Initial_Rate_lng='Enter От начальной скорости';
        $Ride_Time_Rate_lng='Время езды Оценить';
        $Enter_Ride_From_Time_Rate_lng='Введите езды от времени частота';
        $Night_Ride_Time_Rate_lng='Ночь езды Время Оценить';
        $Enter_Night_Ride_From_Time_Rate_lng='Enter Night езды от времени частота';
        $Time_Type_lng='Тип Время';
        $Enter_Time_Type_lng='Введите время Тип';
        $Description_lng='Описание';
        $Enter_Description_lng='Введите описание';
        $Description_Arabic_lng='Описание Арабский';
        $Loading_Capacity_lng='Объем загрузки';
        $SUBMIT_lng='ОТПРАВИТЬ';
    }
    elseif($language == 5)
    {
        $Add_Car_Type_lng='Ajouter un type de voiture';
        $HOMEv='DOMICILE';
        $Car_Image_lng='Image de voiture';
        $Car_Type_lng='Type de voiture';
        $Car_Types_Arabic_lng='Types de voitures arabe';
        $Enter_Car_Types_lng='Entrez les types de voitures';
        $Enter_Car_Types_Arabic_lng='Entrez les types de voitures arabes';
        $Transfer_Type_lng='Type de transfert';
        $Enter_Transfer_Types_lng='Entrez les types de transfert';
        $Transfer_Types_Arabic_lng='Types de transfert Arabe';
        $Enter_Transfer_Types_Arabic_lng='Entrez les types de transfert arabes';
        $Initial_KM_lng='initial KM';
        $Car_Rate_lng='Taux de voiture';
        $Enter_car_rate_lng='Entrez le taux de voiture';
        $Night_Initial_Rate_lng='Nuit Taux initial';
        $Enter_Night_Initial_Rate_lng='Entrer le taux initial de nuit';
        $From_Initial_Rate_lng='À partir du taux initial';
        $Enter_From_Initial_KM_lng='Entrer à partir du KM initial';
        $Night_From_Initial_Rate_lng='Nuit du taux initial';
        $Enter_From_Initial_Rate_lng='Entrer du taux initial';
        $Ride_Time_Rate_lng='Durée du trajet';
        $Enter_Ride_From_Time_Rate_lng='Entrer le temps';
        $Night_Ride_Time_Rate_lng='Durée du trajet';
        $Enter_Night_Ride_From_Time_Rate_lng='Entrer le tour de nuit à partir du taux de temps';
        $Time_Type_lng='Type de temps';
        $Enter_Time_Type_lng='Entrer le type de temps';
        $Description_lng='La description';
        $Enter_Description_lng='Entrer la description';
        $Description_Arabic_lng='Description Arabe';
        $Loading_Capacity_lng='Capacité de chargement';
        $SUBMIT_lng='SOUMETTRE';
    }
    elseif($language == 6)
    {
        $Add_Car_Type_lng='Добави категория кола';
        $HOME_lng='Начало';
        $Car_Image_lng='Иконка';
        $Car_Type_lng='Категория кола';
        $Car_Types_Arabic_lng='Категория кола на арабски';
        $Enter_Car_Types_lng='Въведете Категория кола';
        $Enter_Car_Types_Arabic_lng='Въведете Категория кола на арабски';
        $Transfer_Type_lng='Вид трансфер (не е задължително)';
        $Enter_Transfer_Types_lng='Въведете вид трансфер';
        $Transfer_Types_Arabic_lng='Вид трансфер на арабски';
        $Enter_Transfer_Types_Arabic_lng='Въведете вид трансфер на арабски';
        $Initial_KM_lng='Първоначални километри';
        $Car_Rate_lng='Тарифа такси';
        $Enter_car_rate_lng='Въведете тарифа такси';
        $Night_Initial_Rate_lng='Начална нощна тарифа';
        $Enter_Night_Initial_Rate_lng='Въведете начална нощна тарифа';
        $From_Initial_Rate_lng='Начална тарифа';
        $Enter_From_Initial_KM_lng='Въведете Първоначални КМ';
        $Night_From_Initial_Rate_lng='Нощна начална тарифа';
        $Enter_From_Initial_Rate_lng='Въведете начална тарифа';
        $Ride_Time_Rate_lng='Тарифа на време на возене';
        $Enter_Ride_From_Time_Rate_lng='Въведете тарифа на време на возене';
        $Night_Ride_Time_Rate_lng='Нощна Тарифа на време на возене';
        $Enter_Night_Ride_From_Time_Rate_lng='Въведете Нощна Тарифа на време на возене';
        $Time_Type_lng='Смяна (дневна/нощна)';
        $Enter_Time_Type_lng='Въведете Смяна';
        $Description_lng='Описание';
        $Enter_Description_lng='Въведете Описание';
        $Description_Arabic_lng='Описание на арабски';
        $Loading_Capacity_lng='Товароподемност';
        $SUBMIT_lng='Запази';
    }
}
elseif($urltitle == 'add_car')
{
    if($language == 1)
    {
        $Add_Car_Type_lag ='Add Car Type';
        $HOME_lag='HOME';
        $Car_Image_lag='Car Image';
        $Car_Type_lag='Car Type';
        $Enter_Car_Types_lag='Enter Car Types';
        $Car_Types_Arabic_lag='Car Types Arabic';
        $Enter_Car_Types_Arabic_lag='Enter Car Types Arabic';
        $Transfer_Type_lag='Transfer Type';
        $Enter_Transfer_Types_lag='Enter Transfer Types';
        $Transfer_Types_Arabic_lag='Transfer Types Arabic';
        $Enter_Transfer_Types_Arabic_lag='Enter Transfer Types Arabic';
        $Initial_KM_lag='Initial Miles';
        $Car_Rate_lag='Car Rate';
        $Enter_car_rate_lag='Enter car rate';
        $Night_Initial_Rate_lag='Night Initial Rate';
        $Enter_Night_Initial_Rate_lag='Enter Night Initial Rate';
        $From_Initial_Rate_lag='From Initial Rate';
        $Enter_From_Initial_KM_lag='Enter From Initial Miles';
        $Night_From_Initial_Rate_lag='Night From Initial Rate';
        $Enter_From_Initial_Rate_lag='Enter From Initial Rate';
        $Ride_Time_Rate_lag='Ride Time Rate';
        $Enter_Ride_From_Time_Rate_lag='Enter Ride From Time Rate';
        $Night_Ride_Time_Rate_lag='Night Ride Time Rate';
        $Enter_Night_Ride_From_Time_Rate_lag='Enter Night Ride From Time Rate';
        $Time_Type_lag='Time Type';
        $Enter_Time_Type_lag='Enter Time Type';
        $Description_lag='Description';
        $Enter_Description_lag='Enter Description';
        $Description_Arabic_lag='Description Arabic';
        $Loading_Capacity_lag='Loading Capacity';
        $SUBMIT_lag='SUBMIT';
    }
    elseif($language == 2)
    {
        $Add_Car_Type_lag='Auto hinzufügen';
        $HOME_lag='ZUHAUSE';
        $Car_Image_lag='Auto-Bild';
        $Car_Type_lag='Auto Typ';
        $Car_Types_Arabic_lag='Autotypen Arabisch';
        $Enter_Car_Types_lag='Geben Sie Fahrzeugtypen ein';
        $Enter_Car_Types_Arabic_lag='Geben Sie Autotypen Arabisch';
        $Transfer_Type_lag='Transfer-Typ';
        $Enter_Transfer_Types_lag='Geben Sie Übertragungsarten';
        $Transfer_Types_Arabic_lag='Transfertypen Arabisch';
        $Enter_Transfer_Types_Arabic_lag='Geben Sie Transfertypen Arabisch';
        $Initial_KM_lag='Erste Miles';
        $Car_Rate_lag='Autotarif';
        $Enter_car_rate_lag='Geben Sie Autotarif ein';
        $Night_Initial_Rate_lag='Nacht Initial Rate';
        $Enter_Night_Initial_Rate_lag='Geben Sie die Nacht-Initialrate ein';
        $From_Initial_Rate_lag='Von der Anfangsrate';
        $Enter_From_Initial_KM_lag='Von Anfangs-KM eingeben';
        $Night_From_Initial_Rate_lag='Nacht ab Anfangsrate';
        $Enter_From_Initial_Rate_lag='Geben Sie von der Anfangsrate ein';
        $Ride_Time_Rate_lag='Fahrzeit';
        $Enter_Ride_From_Time_Rate_lag='Geben Sie Ride From Time Rate ein';
        $Night_Ride_Time_Rate_lag='Nachtfahrtzeit';
        $Enter_Night_Ride_From_Time_Rate_lag='Geben Sie die Nachtfahrt von der Zeitrate ein';
        $Time_Type_lag='Zeittyp';
        $Enter_Time_Type_lag='Geben Sie Uhrzeitart ein';
        $Description_lag='Beschreibung';
        $Enter_Description_lag='Geben Sie Beschreibung ein';
        $Description_Arabic_lag='Beschreibung Arabic';
        $Loading_Capacity_lag='Tragfähigkeit';
        $SUBMIT_lag='EINREICHEN';
    }
    elseif($language == 3)
    {
        $Add_Car_Type_lag='Aggiungi tipo di auto';
        $HOME_lag='CASA';
        $Car_Image_lag='Car Immagine';
        $Car_Type_lag='Tipo di macchina';
        $Car_Types_Arabic_lag='Tipi di auto arabo';
        $Enter_Car_Types_lag='Намудҳои мошини ворид кунед';
        $Enter_Car_Types_Arabic_lag='Inserisci Tipi auto arabi';
        $Transfer_Type_lag='Tipo di trasferimento';
        $Enter_Transfer_Types_lag='Inserisci Tipi di trasferimento';
        $Transfer_Types_Arabic_lag='Tipi di trasferimento arabo';
        $Enter_Transfer_Types_Arabic_lag='Inserisci Tipi di trasferimento arabi';
        $Initial_KM_lag='KM iniziale';
        $Car_Rate_lag='auto Tasso';
        $Enter_car_rate_lag='Inserisci tasso di noleggio';
        $Night_Initial_Rate_lag='Notte tasso iniziale';
        $Enter_Night_Initial_Rate_lag='Inserisci Notte tasso iniziale';
        $From_Initial_Rate_lag='Dal tasso iniziale';
        $Enter_From_Initial_KM_lag='Inserisci Da KM iniziale';
        $Night_From_Initial_Rate_lag='Notte da Tasso iniziale';
        $Enter_From_Initial_Rate_lag='Inserisci Da tasso iniziale';
        $Ride_Time_Rate_lag='Giro Time Rate';
        $Enter_Ride_From_Time_Rate_lag='Inserisci Ride Da Time Rate';
        $Night_Ride_Time_Rate_lag='Night Ride Time Rate';
        $Enter_Night_Ride_From_Time_Rate_lag='Inserisci Night Ride Da Time Rate';
        $Time_Type_lag='Tipo tempo';
        $Enter_Time_Type_lag='Inserisci Ora Tipo';
        $Description_lag='Descrizione';
        $Enter_Description_lag='Inserisci Descrizione';
        $Description_Arabic_lag='Descrizione arabo';
        $Loading_Capacity_lag='Capacità di carico';
        $SUBMIT_lag='INVIO';
    }
    elseif($language == 4)
    {
        $Add_Car_Type_lag='Добавить тип автомобиля';
        $HOME_lag='ГЛАВНАЯ';
        $Car_Image_lag='Автомобиль изображение';
        $Car_Type_lag='Тип автомобиля';
        $Car_Types_Arabic_lag='Типы автомобилей арабский';
        $Enter_Car_Types_lag='Введите типы автомобилей';
        $Enter_Car_Types_Arabic_lag='Введите автомобилей Типы арабский';
        $Transfer_Type_lag='Тип передачи';
        $Enter_Transfer_Types_lag='Введите типы передачи';
        $Transfer_Types_Arabic_lag='Типы передачи арабский';
        $Enter_Transfer_Types_Arabic_lag='Введите типы передачи арабский';
        $Initial_KM_lag='Первоначальная KM';
        $Car_Rate_lag='Автомобиль Оценить';
        $Enter_car_rate_lag='Введите скорость автомобиля';
        $Night_Initial_Rate_lag='Ночь начальная скорость';
        $Enter_Night_Initial_Rate_lag='Введите Night начальная скорость';
        $From_Initial_Rate_lag='От начальной скорости';
        $Enter_From_Initial_KM_lag='Введите от первоначального KM';
        $Night_From_Initial_Rate_lag='Ночь от начальной скорости';
        $Enter_From_Initial_Rate_lag='Enter От начальной скорости';
        $Ride_Time_Rate_lag='Время езды Оценить';
        $Enter_Ride_From_Time_Rate_lag='Введите езды от времени частота';
        $Night_Ride_Time_Rate_lag='Ночь езды Время Оценить';
        $Enter_Night_Ride_From_Time_Rate_lag='Enter Night езды от времени частота';
        $Time_Type_lag='Тип Время';
        $Enter_Time_Type_lag='Введите время Тип';
        $Description_lag='Описание';
        $Enter_Description_lag='Введите описание';
        $Description_Arabic_lag='Описание Арабский';
        $Loading_Capacity_lag='Объем загрузки';
        $SUBMIT_lag='ОТПРАВИТЬ';
    }
    elseif($language == 5)
    {
        $Add_Car_Type_lag='Ajouter un type de voiture';
        $HOME_lag='DOMICILE';
        $Car_Image_lag='Image de voiture';
        $Car_Type_lag='Type de voiture';
        $Car_Types_Arabic_lag='Types de voitures arabe';
        $Enter_Car_Types_lag='Entrez les types de voitures';
        $Enter_Car_Types_Arabic_lag='Entrez les types de voitures arabes';
        $Transfer_Type_lag='Type de transfert';
        $Enter_Transfer_Types_lag='Entrez les types de transfert';
        $Transfer_Types_Arabic_lag='Types de transfert Arabe';
        $Enter_Transfer_Types_Arabic_lag='Entrez les types de transfert arabes';
        $Initial_KM_lag='initial KM';
        $Car_Rate_lag='Taux de voiture';
        $Enter_car_rate_lag='Entrez le taux de voiture';
        $Night_Initial_Rate_lag='Nuit Taux initial';
        $Enter_Night_Initial_Rate_lag='Entrer le taux initial de nuit';
        $From_Initial_Rate_lag='À partir du taux initial';
        $Enter_From_Initial_KM_lag='Entrer à partir du KM initial';
        $Night_From_Initial_Rate_lag='Nuit du taux initial';
        $Enter_From_Initial_Rate_lag='Entrer du taux initial';
        $Ride_Time_Rate_lag='Durée du trajet';
        $Enter_Ride_From_Time_Rate_lag='Entrer le temps';
        $Night_Ride_Time_Rate_lag='Durée du trajet';
        $Enter_Night_Ride_From_Time_Rate_lag='Entrer le tour de nuit à partir du taux de temps';
        $Time_Type_lag='Type de temps';
        $Enter_Time_Type_lag='Entrer le type de temps';
        $Description_lag='La description';
        $Enter_Description_lag='Entrer la description';
        $Description_Arabic_lag='Description Arabe';
        $Loading_Capacity_lag='Capacité de chargement';
        $SUBMIT_lag='SOUMETTRE';
    }
    elseif($language == 6)
    {
        $Add_Car_Type_lag='Добави категория кола';
        $HOME_lag='Начало';
        $Car_Image_lag='Иконка';
        $Car_Type_lag='Категория кола';
        $Car_Types_Arabic_lag='Категория кола на арабски';
        $Enter_Car_Types_lag='Въведете Категория кола';
        $Enter_Car_Types_Arabic_lag='Въведете Категория кола на арабски';
        $Transfer_Type_lag='Вид трансфер (не е задължително)';
        $Enter_Transfer_Types_lag='Въведете вид трансфер';
        $Transfer_Types_Arabic_lag='Вид трансфер на арабски';
        $Enter_Transfer_Types_Arabic_lag='Въведете вид трансфер на арабски';
        $Initial_KM_lag='Първоначални километри';
        $Car_Rate_lag='Тарифа такси';
        $Enter_car_rate_lag='Въведете тарифа такси';
        $Night_Initial_Rate_lag='Начална нощна тарифа';
        $Enter_Night_Initial_Rate_lag='Въведете начална нощна тарифа';
        $From_Initial_Rate_lag='Начална тарифа';
        $Enter_From_Initial_KM_lag='Въведете Първоначални КМ';
        $Night_From_Initial_Rate_lag='Нощна начална тарифа';
        $Enter_From_Initial_Rate_lag='Въведете начална тарифа';
        $Ride_Time_Rate_lag='Тарифа на време на возене';
        $Enter_Ride_From_Time_Rate_lag='Въведете тарифа на време на возене';
        $Night_Ride_Time_Rate_lag='Нощна Тарифа на време на возене';
        $Enter_Night_Ride_From_Time_Rate_lag='Въведете Нощна Тарифа на време на возене';
        $Time_Type_lag='Смяна (дневна/нощна)';
        $Enter_Time_Type_lag='Въведете Смяна';
        $Description_lag='Описание';
        $Enter_Description_lag='Въведете Описание';
        $Description_Arabic_lag='Описание на арабски';
        $Loading_Capacity_lag='Товароподемност';
        $SUBMIT_lag='Запази';
    }
}
elseif($urltitle == 'add_inspection')
{
    if($language == 1)
    {
        $Add_Insection_point ='Inspection Point';
        $HOME_lag = 'Home';

    }
    elseif($language == 2)
    {
        $Add_Insection_point='Inspection Point';

    }
    elseif($language == 3)
    {
        $Add_Insection_point='Inspection Point';

    }
    elseif($language == 4)
    {
        $Add_Insection_point='Inspection Point';

    }
    elseif($language == 5)
    {
        $Add_Insection_point='Inspection Point';

    }
    elseif($language == 6)
    {
        $Add_Insection_point='Inspection Point';

    }
}
elseif($urltitle == 'manage_delay_reasons')
{
    if($language == 1)
    {
        $Manage_Delay_Reason_lng='Manage Delay Reason';
        $HOME_lag='HOME';
        $Add_lng='Add';
        $Reason_ID_lng='Reason ID';
        $Reason_Title_lng='Reason Title';
        $Reason_Text_lng='Reason Text';
        $Action_lng='Action';
        $delete_alert_lng='Are you sure you want to delete the selected reason?';
        $OK_lng='OK';
        $CANCEL_lng='CANCEL';
        $Multiple_Delete_lng='Multiple Delete';
    }
    elseif($language == 2)
    {
        $Manage_Delay_Reason_lng='Verwalten Verzögerungsgründe';
        $HOME_lag='ZUHAUSE';
        $Add_lng='Hinzufügen';
        $Reason_ID_lng='Grund-ID';
        $Reason_Title_lng='Begründung';
        $Reason_Text_lng='Grundtext';
        $Action_lng='Aktion';
        $delete_alert_lng='Möchten Sie den ausgewählten Grund wirklich löschen?';
        $OK_lng='OK';
        $CANCEL_lng='STORNIEREN';
        $Multiple_Delete_lng='Mehrfach löschen';
    }
    elseif($language == 3)
    {
        $Manage_Delay_Reason_lng='Gestire ritardo Motivo';
        $HOME_lag='CASA';
        $Add_lng='Aggiungere';
        $Reason_ID_lng='ID ragione';
        $Reason_Title_lng='motivo Titolo';
        $Reason_Text_lng='motivo di testo';
        $Action_lng='Azione';
        $delete_alert_lng='Sei sicuro di voler cancellare la ragione selezionato?';
        $OK_lng='ok';
        $CANCEL_lng='ANNULLA';
        $Multiple_Delete_lng='Elimina multipla';
    }
    elseif($language == 4)
    {
        $Manage_Delay_Reason_lng='Управление задержки Причина';
        $HOME_lag='ГЛАВНАЯ';
        $Add_lng='Добавить';
        $Reason_ID_lng='Причина ID';
        $Reason_Title_lng='Причина Название';
        $Reason_Text_lng='Причина Текст';
        $Action_lng='действие';
        $delete_alert_lng='Вы уверены, что хотите удалить выбранную причину?';
        $OK_lng='ОК';
        $CANCEL_lng='ОТМЕНА';
        $Multiple_Delete_lng='Удалить несколько';
    }
    elseif($language == 5)
    {
        $Manage_Delay_Reason_lng='Gérer la raison du retard';
        $HOME_lag='DOMICILE';
        $Add_lng='Ajouter';
        $Reason_ID_lng='ID de raison';
        $Reason_Title_lng='Titre de la raison';
        $Reason_Text_lng='Texte de la raison';
        $Action_lng='action';
        $delete_alert_lng='Voulez-vous vraiment supprimer la raison sélectionnée?';
        $OK_lng='D\'accord';
        $CANCEL_lng='ANNULER';
        $Multiple_Delete_lng='Suppression multiple';
    }
    elseif($language == 6)
    {
        $Manage_Delay_Reason_lng='Причини за забавяне';
        $HOME_lag='Начало';
        $Add_lng='Добави';
        $Reason_ID_lng='Причина ID';
        $Reason_Title_lng='Причина Загалвие';
        $Reason_Text_lng='Причина Текст';
        $Action_lng='Действия';
        $delete_alert_lng='Сигурни ли сте че искате да изтриете избраната причина?';
        $OK_lng='ОК';
        $CANCEL_lng='ОТКАЗ';
        $Multiple_Delete_lng='Изтриване';
    }
}
elseif($urltitle == 'add_reason')
{
    if($language == 1)
    {
        $Add_Reason_lng='Add Reason';
        $Home_lng='Home';
        $Add_Reason_lng='Add Reason';
        $Reason_Title_lng='Reason Title';
        $Enter_Title_lng='Enter Title';
        $Reason_Text_lng='Reason Text';
        $Enter_Reason_lng='Enter Reason';
        $SUBMIT_lng='SUBMIT';
    }
    elseif($language == 2)
    {
        $Add_Reason_lng='Grund hinzufügen';
        $Home_lng='Zuhause';
        $Reason_Title_lng='Begründung';
        $Enter_Title_lng='Geben Sie den Titel ein';
        $Reason_Text_lng='Grundtext';
        $Enter_Reason_lng='Geben Sie Grund ein';
        $SUBMIT_lng='EINREICHEN';
    }
    elseif($language == 3)
    {
        $Add_Reason_lng='Aggiungere Motivo';
        $Home_lng='Casa';
        $Reason_Title_lng='motivo Titolo';
        $Enter_Title_lng='Inserire Titolo';
        $Reason_Text_lng='motivo di testo';
        $Enter_Reason_lng='Inserisci Motivo';
        $SUBMIT_lng='INVIO';
    }
    elseif($language == 4)
    {
        $Add_Reason_lng='Добавить Причина';
        $Home_lng='Главная';
        $Reason_Title_lng='Причина Название';
        $Enter_Title_lng='Введите заголовок';
        $Reason_Text_lng='Причина Текст';
        $Enter_Reason_lng='Введите причину';
        $SUBMIT_lng='ОТПРАВИТЬ';
    }
    elseif($language == 5)
    {
        $Add_Reason_lng='Ajouter Raison';
        $Home_lng='Accueil';
        $Reason_Title_lng='Titre de la raison';
        $Enter_Title_lng='Entrer le titre';
        $Reason_Text_lng='Texte de la raison';
        $Enter_Reason_lng='Entrez la raison';
        $SUBMIT_lng='SOUMETTRE';
    }
    elseif($language == 6)
    {
        $Add_Reason_lng='Добави Причина';
        $Home_lng='Начало';
        $Reason_Title_lng='Причина Заглавие';
        $Enter_Title_lng='Въведете Заглавие';
        $Reason_Text_lng='Причина Текст';
        $Enter_Reason_lng='Въведете Причина';
        $SUBMIT_lng='Добави';
    }
}
elseif($urltitle == 'view_delayreason_details')
{
    if($language == 1)
    {
        $Delay_Reason_lng='Delay Reason';
        $HOME_lag='Home';
        $Edit_Delay_Reason_lng='Edit Delay Reason';
        $Reason_Title_lng='Reason Title';
        $Enter_Title_lng='Enter title';
        $Reason_Text_lng='Reason Text';
        $Enter_Reason_lng='Enter reason';
        $SUBMIT_lng='SUBMIT';
    }
    elseif($language == 2)
    {
        $Delay_Reason_lng='Verzögerungsgrund';
        $HOME_lag='ZUHAUSE';
        $Edit_Delay_Reason_lng='Bearbeitungsverzögerungsgrund';
        $Reason_Title_lng='Begründung';
        $Enter_Title_lng='Geben Sie den Titel ein';
        $Reason_Text_lng='Grundtext';
        $Enter_Reason_lng='Geben Sie den Grund ein';
        $SUBMIT_lng='EINREICHEN';
    }
    elseif($language == 3)
    {
        $Delay_Reason_lng='ritardo Motivo';
        $HOME_lag='CASA';
        $Edit_Delay_Reason_lng='Modifica ritardo Motivo';
        $Reason_Title_lng='motivo Titolo';
        $Enter_Title_lng='Inserire titolo';
        $Reason_Text_lng='motivo di testo';
        $Enter_Reason_lng='Inserisci ragione';
        $SUBMIT_lng='INVIO';
    }
    elseif($language == 4)
    {
        $Delay_Reason_lng='Задержка Причина';
        $HOME_lag='ГЛАВНАЯ';
        $Edit_Delay_Reason_lng='Edit Delay Reason';
        $Reason_Title_lng='Причина Название';
        $Enter_Title_lng='Введите название';
        $Reason_Text_lng='Причина Текст';
        $Enter_Reason_lng='Введите причину';
        $SUBMIT_lng='ОТПРАВИТЬ';
    }
    elseif($language == 5)
    {
        $Delay_Reason_lng='Délai de la raison';
        $HOME_lag='DOMICILE';
        $Edit_Delay_Reason_lng='Modifier la raison du retard';
        $Reason_Title_lng='Titre de la raison';
        $Enter_Title_lng='Entrer le titre';
        $Reason_Text_lng='Texte de la raison';
        $Enter_Reason_lng='Entrez la raison';
        $SUBMIT_lng='SOUMETTRE';
    }
    elseif($language == 6)
    {
        $Delay_Reason_lng='Причина за забавяне';
        $HOME_lag='Начало';
        $Edit_Delay_Reason='Редаккция Причина';
        $Reason_Title_lng='Причина Заглавие';
        $Enter_Title_lng='Въведете заглавие';
        $Reason_Text_lng='Причина Текст';
        $Enter_Reason_lng='Въведете причина';
        $SUBMIT_lng='Запази';
    }
}
elseif($urltitle == 'manage_fix_price_area')
{
    if($language == 1)
    {
        $Manage_Area_lng ='Manage Area';
        $HOME_lng='HOME';
        $Add_lng='Add';
        $Title_lng='Title';
        $Range_lng='Range';
        $Price_lng='Price';
        $Car_Type_lag='Car Type';
        $Latitude_lng='Latitude';
        $Longitude_lng='Longitude';
        $Action_lng='Action';
        $Multiple_Delete_lng='Multiple Delete';
        $delete_alert_lng='Are you sure you want to delete the selected area?';
        $OK='OK';
        $CANCEL='CANCEL';
    }
    elseif($language == 2)
    {
        $Manage_Area_lng='Bereich verwalten';
        $HOME_lag='ZUHAUSE';
        $Add_lng='Hinzufügen';
        $Title_lng='Titel';
        $Range_lng='Angebot';
        $Price_lng='Preis';
        $Car_Type_lag='Auto Typ';
        $Latitude_lng='Breite';
        $Longitude_lng='Länge';
        $Action_lng='Aktion';
        $Multiple_Delete_lng='Mehrfach löschen';
        $delete_alert_lng='Möchten Sie den ausgewählten Bereich wirklich löschen?';
        $OK='OK';
        $CANCEL='STORNIEREN';
    }
    elseif($language == 3)
    {
        $Manage_Area_lng='Gestione Area';
        $HOME_lng='CASA';
        $Add_lng='Aggiungere';
        $Title_lng='Titolo';
        $Range_lng='Gamma';
        $Price_lng='Prezzo';
        $Car_Type_lag='Tipo di macchina';
        $Latitude_lng='Latitudine';
        $Longitude_lng='Longitudine';
        $Action_lng='Azione';
        $Multiple_Delete_lng='Elimina multipla';
        $delete_alert_lng='Sei sicuro di voler eliminare l\'area selezionata';
        $OK='ok';
        $CANCEL='ANNULLA';
    }
    elseif($language == 4)
    {
        $Manage_Area_lng='Управление Area';
        $HOME_lng='ГЛАВНАЯ';
        $Add_lng='Добавить';
        $Title_lng='заглавие';
        $Range_lng='Ассортимент';
        $Price_lng='Цена';
        $Car_Type_lag='Тип автомобиля';
        $Latitude_lng='долгота';
        $Longitude_lng='долгота';
        $Action_lng='действие';
        $Multiple_Delete_lng='Удалить несколько';
        $delete_alert_lng='Вы уверены, что хотите удалить выбранную область';
        $OK='ОК';
        $CANCEL='ОТМЕНА';
    }
    elseif($language == 5)
    {
        $Manage_Area_lng='Gérer zone';
        $HOME_lng='DOMICILE';
        $Add_lng='Ajouter';
        $Title_lng='Titre';
        $Range_lng='Gamme';
        $Price_lng='Prix';
        $Car_Type_lag='Type de voiture';
        $Latitude_lng='Latitude';
        $Longitude_lng='Longitude';
        $Action_lng='action';
        $Multiple_Delete_lng='Suppression multiple';
        $delete_alert_lng='Voulez-vous vraiment supprimer la zone sélectionnée';
        $OK='D\'accord';
        $CANCEL='ANNULER';
    }
    elseif($language == 6)
    {
        $Manage_Area_lng='Управление Площ';
        $HOME_lng='Начало';
        $Add_lng='Добави';
        $Title_lng='Заглавие';
        $Range_lng='диапазон';
        $Price_lng='Цена';
        $Car_Type_lag='Вид на кола';
        $Latitude_lng='Географска ширина';
        $Longitude_lng='Географска дължина';
        $Action_lng='Действия';
        $Multiple_Delete_lng='Изтриване';
        $delete_alert_lng='Сигурни ли сте, че искате да изтриете избраната област';
        $OK='ОК';
        $CANCEL='ОТКАЗ';
    }
}
elseif($urltitle == 'add_fix_price_area')
{
    if($language == 1)
    {
        $Add_Area_lng='Add Area';
        $home_lng='HOME';
        $Pick_Area_lng='Pick Area';
        $Type_Pick_Area_lng='Type Pick Area';
        $Area_Range_lng='Area Range';
        $enter_range_lgn='Enter Range in KM (eg. 123)';
        $Area_Price_lng='Area Price';
        $enter_price_lng='Enter Price of Area (eg. 123)';
        $Truck_Type_lng='Truck Type';
        $UPDATE_lng='UPDATE';
        $SUBMIT_lng='SUBMIT';
    }
    elseif($language == 2)
    {
        $Add_Area_lng='Bereich hinzufügen';
        $home_lng='ZUHAUSE';
        $Pick_Area_lng='Bereich auswählen';
        $Type_Pick_Area_lng='Typ Pick Bereich';
        $Area_Range_lng='Bereichsbereich';
        $enter_range_lgn='Bereich in KM eingeben (zB 123)';
        $Area_Price_lng='Fläche Preis';
        $enter_price_lng='Geben Sie den Preis des Bereichs ein (zB 123)';
        $Truck_Type_lng='Fahrzeugtyp';
        $UPDATE_lng='AKTUALISIEREN';
        $SUBMIT_lng='EINREICHEN';
    }
    elseif($language == 3)
    {
        $Add_Area_lng='Aggiungere Area';
        $home_lng='CASA';
        $Pick_Area_lng='Zone de sélection';
        $Type_Pick_Area_lng='Tipo pick Area';
        $Area_Range_lng='Area Gamma';
        $enter_range_lgn='Inserisci Gamma a KM (ad es. 123)';
        $Area_Price_lng='Area Prezzo';
        $enter_price_lng='Inserisci il prezzo Area di (ad es. 123)';
        $Truck_Type_lng='Tipo di dotazione';
        $UPDATE_lng='AGGIORNARE';
        $SUBMIT_lng='INVIO';
    }
    elseif($language == 4)
    {
        $Add_Area_lng='Добавить Area';
        $home_lng='ГЛАВНАЯ';
        $Pick_Area_lng='Pick Area';
        $Type_Pick_Area_lng='Тип Пика Площадь';
        $Area_Range_lng='Диапазон Площадь';
        $enter_range_lgn='Введите диапазон в КМ (например. 123)';
        $Area_Price_lng='Площадь Цена';
        $enter_price_lng='Введите Цена Площадь (напр. 123)';
        $Truck_Type_lng='Грузовик Тип';
        $UPDATE_lng='ОБНОВИТЬ';
        $SUBMIT_lng='ОТПРАВИТЬ';
    }
    elseif($language == 5)
    {
        $Add_Area_lng='Ajouter une zone';
        $home_lng='DOMICILE';
        $Pick_Area_lng='Zone de sélection';
        $Type_Pick_Area_lng='Type Zone de sélection';
        $Area_Range_lng='Zone géographique';
        $enter_range_lgn='Entrer la plage en KM (par exemple 123)';
        $Area_Price_lng='Région Prix';
        $enter_price_lng='Entrez le prix de la zone (par exemple 123)';
        $Truck_Type_lng='Type de camion';
        $UPDATE_lng='METTRE À JOUR';
        $SUBMIT_lng='SOUMETTRE';
    }
    elseif($language == 6)
    {
        $Add_Area_lng='Добави Area';
        $home_lng='Начало';
        $Pick_Area_lng='Вземете Area';
        $Type_Pick_Area_lng='Вид Pick Area';
        $Area_Range_lng='Площ Range';
        $enter_range_lgn='Въведете Range в KM (напр. 123)';
        $Area_Price_lng='Площ Цена';
        $enter_price_lng='Въведете Цена на площ (напр. 123)';
        $Truck_Type_lng='Вид Truck';
        $UPDATE_lng='UPDATE';
        $SUBMIT_lng='ПРЕДСТАВЯМ';
    }
}
elseif($urltitle == 'manage_time_type')
{
    if($language == 1)
    {
        $Manage_Day_Time_lng='Manage Day Time';
        $HOME_lng='HOME';
        $Start_Time_lng='Start Time';
        $End_Time_lng='End Time';
        $Action_lng='Action';
    }
    elseif($language == 2)
    {
        $Manage_Day_Time_lng='Tageszeit verwalten';
        $HOME_lng='ZUHAUSE';
        $Start_Time_lng='Startzeit';
        $End_Time_lng='Endzeit';
        $Action_lng='Aktion';
    }
    elseif($language == 3)
    {
        $Manage_Day_Time_lng='Gestire Day Time';
        $HOME_lng='CASA';
        $Start_Time_lng='Ora di inizio';
        $End_Time_lng='Fine del tempo';
        $Action_lng='Azione';
    }
    elseif($language == 4)
    {
        $Manage_Day_Time_lng='Управление в дневное время';
        $HOME_lng='ГЛАВНАЯ';
        $Start_Time_lng='Время начала';
        $End_Time_lng='Время окончания';
        $Action_lng='действие';
    }
    elseif($language == 5)
    {
        $Manage_Day_Time_lng='Gérer le jour';
        $HOME_lng='DOMICILE';
        $Start_Time_lng='Heure de départ';
        $End_Time_lng='Heure de fin';
        $Action_lng='action';
    }
    elseif($language == 6)
    {
        $Manage_Day_Time_lng='Управление Работно време';
        $HOME_lng='Начало';
        $Start_Time_lng='Начало';
        $End_Time_lng='Край';
        $Action_lng='Действие';
    }
}
elseif($urltitle == 'edit_time_type')
{
    if($language == 1)
    {
        $Day_Time_lng='Day Time';
        $HOME_lng='HOME';
        $Start_Time_lng='Start Time';
        $Enter_start_time_lng='Enter start time';
        $End_Time_lng='End Time';
        $Enter_end_time_lng='Enter end time';
        $SUBMIT_lng='SUBMIT';
    }
    elseif($language == 2)
    {
        $Day_Time_lng='Tageszeit';
        $HOME_lng='ZUHAUSE';
        $Start_Time_lng='Startzeit';
        $Enter_start_time_lng='Startzeit eingeben';
        $End_Time_lng='Endzeit';
        $Enter_end_time_lng='Endzeit eingeben';
        $SUBMIT_lng='EINREICHEN';
    }
    elseif($language == 3)
    {
        $Day_Time_lng='Day Time';
        $HOME_lng='CASA';
        $Start_Time_lng='Ora di inizio';
        $Enter_start_time_lng='Immettere l\'ora di inizio';
        $End_Time_lng='Fine del tempo';
        $Enter_end_time_lng='Inserire l\'ora di fine';
        $SUBMIT_lng='INVIO';
    }
    elseif($language == 4)
    {
        $Day_Time_lng='День Время';
        $HOME_lng='ГЛАВНАЯ';
        $Start_Time_lng='Время начала';
        $Enter_start_time_lng='Введите время начала';
        $End_Time_lng='Время окончания';
        $Enter_end_time_lng='Введите время окончания';
        $SUBMIT_lng='ОТПРАВИТЬ';
    }
    elseif($language == 5)
    {
        $Day_Time_lng='Heure du jour';
        $HOME_lng='DOMICILE';
        $Start_Time_lng='Heure de départ';
        $Enter_start_time_lng='Entrez l\'heure de début';
        $End_Time_lng='Heure de fin';
        $Enter_end_time_lng='Saisir l\'heure de fin';
        $SUBMIT_lng='SOUMETTRE';
    }
    elseif($language == 6)
    {
        $Day_Time_lng='Времетраене';
        $HOME_lng='Начало';
        $Start_Time_lng='Начало';
        $Enter_start_time_lng='Въвеете начало';
        $End_Time_lng='Край';
        $Enter_end_time_lng='Въведете край';
        $SUBMIT_lng='Запази';
    }
}
elseif($urltitle == 'update_web_commision')
{
    if($language == 1)
    {
        $Commision_Setting_lng='Commision Setting';
        $HOME_lag='HOME';
        $SUBMIT_lng='SUBMIT';
    }
    elseif($language == 2)
    {
        $Commision_Setting_lng='Einstellung Commision';
        $HOME_lag='ZUHAUSE';
        $SUBMIT_lng='EINREICHEN';
    }
    elseif($language == 3)
    {
        $Commision_Setting_lng='Commision Impostazione';
        $HOME_lag='CASA';
        $SUBMIT_lng='INVIO';
    }
    elseif($language == 4)
    {
        $Commision_Setting_lng='Commision Окружение';
        $HOME_lag='ГЛАВНАЯ';
        $SUBMIT_lng='ОТПРАВИТЬ';
    }
    elseif($language == 5)
    {
        $Commision_Setting_lng='Commision Setting';
        $HOME_lag='DOMICILE';
        $SUBMIT_lng='SOUMETTRE';
    }
    elseif($language == 6)
    {
        $Commision_Setting_lng='Комисионна';
        $HOME_lag='Начало';
        $SUBMIT_lng='Запази';
    }
}
elseif($urltitle == 'profile')
{
    if($language == 1)
    {
        $Admin_Profile_lng='Admin Profile';
        $Home_lng='Home';
        $Image_lng='Image';
        $Name_lng='Name';
        $Enter_name_lng='Enter name';
        $User_Name_lng='User Name';
        $Enter_userName_lng='Enter userName';
        $Email_lng='Email';
        $Enter_email_address_lng='Enter email address';
        $Contact_No_lng='Contact No';
        $Enter_contact_number_lng='Enter contact number';
        $Role_lng='Role';
        $SUBMIT_lng='SUBMIT';
    }
    elseif($language == 2)
    {
        $Admin_Profile_lng='Admin-Profil';
        $Home_lng='Zuhause';
        $Image_lng='Image';
        $Name_lng='Name';
        $Enter_name_lng='Name eingeben';
        $User_Name_lng='Benutzername';
        $Enter_userName_lng='Geben Sie userName ein';
        $Email_lng='Email';
        $Enter_email_address_lng='E-Mail Adresse eingeben';
        $Contact_No_lng='Kontakt-Nr';
        $Enter_contact_number_lng='Geben Sie die Kontaktnummer ein';
        $Role_lng='Rolle';
        $SUBMIT_lng='EINREICHEN';
    }
    elseif($language == 3)
    {
        $Admin_Profile_lng='Profilo Admin';
        $Home_lng='Casa';
        $Image_lng='Immagine';
        $Name_lng='Nome';
        $Enter_name_lng='Inserisci il nome';
        $User_Name_lng='Nome utente';
        $Enter_userName_lng='Inserire username';
        $Email_lng='E-mail';
        $Enter_email_address_lng='Inserisci l\'indirizzo email';
        $Contact_No_lng='Contatto No';
        $Enter_contact_number_lng='Inserire il numero di telefono';
        $Role_lng='Ruolo';
        $SUBMIT_lng='INVIO';
    }
    elseif($language == 4)
    {
        $Admin_Profile_lng='Администратор профиля';
        $Home_lng='Главная';
        $Image_lng='Образ';
        $Name_lng='имя';
        $Enter_name_lng='Введите имя';
        $User_Name_lng='имя пользователя';
        $Enter_userName_lng='Введите имя пользователя';
        $Email_lng='Эл. адрес';
        $Enter_email_address_lng='Введите адрес электронной почты';
        $Contact_No_lng='Как связаться с Нет';
        $Enter_contact_number_lng='Введите контактный номер';
        $Role_lng='Роль';
        $SUBMIT_lng='ОТПРАВИТЬ';
    }
    elseif($language == 5)
    {
        $Admin_Profile_lng='Profil Admin';
        $Home_lng='Accueil';
        $Image_lng='image';
        $Name_lng='prénom';
        $Enter_name_lng='Entrez le nom';
        $User_Name_lng='Nom d\'utilisateur';
        $Enter_userName_lng='Entrez userName';
        $Email_lng='Email';
        $Enter_email_address_lng='Entrer l\'adresse e-mail';
        $Contact_No_lng='Contact Non';
        $Enter_contact_number_lng='Entrer le numéro de contact';
        $Role_lng='Rôle';
        $SUBMIT_lng='SOUMETTRE';
    }
    elseif($language == 6)
    {
        $Admin_Profile_lng='Администраторски профил';
        $Home_lng='Начало';
        $Image_lng='Изображение';
        $Name_lng='Име';
        $Enter_name_lng='Въведете име';
        $User_Name_lng='Потребителско име';
        $Enter_userName_lng='Въведете потребителско име';
        $Email_lng='Email';
        $Enter_email_address_lng='Въведи email';
        $Contact_No_lng='Телефон';
        $Enter_contact_number_lng='Въведете телефон';
        $Role_lng='Роля';
        $SUBMIT_lng='Запази';
    }
}
elseif($urltitle == 'password_change')
{
    if($language == 1)
    {
        $home_lng='HOME';
        $Change_Password_lng='Change Password';
        $New_Password_lng='New Password';
        $Enter_New_Password_lng='Enter New Password';
        $Enter_Confirm_Password_lng='Enter Confirm Password';
        $Confirm_Password_lng='Confirm Password';
        $SUBMIT_lng='SUBMIT';
    }
    elseif($language == 2)
    {
        $home_lng='ZUHAUSE';
        $Change_Password_lng='Passwort ändern';
        $New_Password_lng='Neues Kennwort';
        $Enter_New_Password_lng='Neues Passwort eingeben';
        $Enter_Confirm_Password_lng='Geben Sie Kennwort bestätigen ein';
        $Confirm_Password_lng='Bestätige das Passwort';
        $SUBMIT_lng='EINREICHEN';
    }
    elseif($language == 3)
    {
        $home_lng='CASA';
        $Change_Password_lng='Cambia la password';
        $New_Password_lng='nuova password';
        $Enter_New_Password_lng='Inserire una nuova password';
        $Enter_Confirm_Password_lng='Invio Conferma password';
        $Confirm_Password_lng='conferma password';
        $SUBMIT_lng='INVIO';
    }
    elseif($language == 4)
    {
        $home_lng='ГЛАВНАЯ';
        $Change_Password_lng='Изменить пароль';
        $New_Password_lng='новый пароль';
        $Enter_New_Password_lng='Введите новый пароль';
        $Enter_Confirm_Password_lng='Enter Подтверждение пароля';
        $Confirm_Password_lng='Подтвердите Пароль';
        $SUBMIT_lng='ОТПРАВИТЬ';
    }
    elseif($language == 5)
    {
        $home_lng='DOMICILE';
        $Change_Password_lng='Changer le mot de passe';
        $New_Password_lng='nouveau mot de passe';
        $Enter_New_Password_lng='Entrez un nouveau mot de passe';
        $Enter_Confirm_Password_lng='Entrer Confirmer mot de passe';
        $Confirm_Password_lng='Confirmez le mot de passe';
        $SUBMIT_lng='SOUMETTRE';
    }
    elseif($language == 6)
    {
        $home_lng='Начало';
        $Change_Password_lng='Смяна на парола';
        $New_Password_lng='Нова парола';
        $Enter_New_Password_lng='Въведете новата парола';
        $Enter_Confirm_Password_lng='Потвърдете паролата';
        $Confirm_Password_lng='Потвърди парола';
        $SUBMIT_lng='Запази';
    }
}
elseif($urltitle == 'Daily_Driver_Earnings')
{
    if($language == 1)
    {
        $Daily_Driver_Earnings_lng='Daily Driver Earnings';
        $home_lng='HOME';
        $Driver_Id_lng='Driver Id';
        $Driver_Name_lng='Driver Name';
        $Driver_Earnings_lng='Driver Earnings';
        $Website_Earnings_lng='Website Earnings';
	$Total_Earnings_lng='Total Earnings';
    }
    elseif($language == 2)
    {
        $Daily_Driver_Earnings_lng='Tägliche Fahrereinnahmen';
        $home_lng='ZUHAUSE';
        $Driver_Id_lng='Treiber-ID';
        $Driver_Name_lng='Fahrername';
        $Driver_Earnings_lng='Fahrereinnahmen';
        $Website_Earnings_lng='Website Erträge';
	$Total_Earnings_lng='Gesamteinnahmen';
    }
    elseif($language == 3)
    {
        $Daily_Driver_Earnings_lng='Guadagni conducente quotidiano';
        $home_lng='CASA';
        $Driver_Id_lng='autista Id';
        $Driver_Name_lng='Nome del driver';
        $Driver_Earnings_lng='Guadagni driver';
        $Website_Earnings_lng='Guadagni del sito web';
	$Total_Earnings_lng='Guadagni complessivi';
    }
    elseif($language == 4)
    {
        $Daily_Driver_Earnings_lng='Ежедневные доходы водителя';
        $home_lng='ГЛАВНАЯ';
        $Driver_Id_lng='Id Driver';
        $Driver_Name_lng='Название драйвера';
        $Driver_Earnings_lng='Заработок водителя';
        $Website_Earnings_lng='Прибыль сайта';
	$Total_Earnings_lng='Общий доход';
    }
    elseif($language == 5)
    {
        $Daily_Driver_Earnings_lng='Gains quotidiens des conducteurs';
        $home_lng='DOMICILE';
        $Driver_Id_lng='ID du pilote';
        $Driver_Name_lng='Nom du conducteur';
        $Driver_Earnings_lng='Gains des conducteurs';
        $Website_Earnings_lng='Gains du site Web';
	$Total_Earnings_lng='Total des gains';
    }
    elseif($language == 6)
    {
        $Daily_Driver_Earnings_lng='Дневни Доходи на шофьори';
        $home_lng='Начало';
        $Driver_Id_lng='Шофьор ID';
        $Driver_Name_lng='Име';
        $Driver_Earnings_lng='Печалба';
        $Website_Earnings_lng='Доходи от сайт';
	$Total_Earnings_lng='Общо приходите';
    }
}
?>
