<?php

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-04-18 at 12:37:49.
 */
include '../dataSource.php';
class dataSourceTest extends PHPUnit_Framework_TestCase {

    /**
     * @var dataSource
     */
    protected $object;
   

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new dataSource;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers dataSource::getUser
     * @todo   Implement testGetUser().
     */
    public function testGetUser() {
        // Remove the following lines when you implement this test.
        $testUser = new User(1, "Thomas", "Kragsberger");
        $actualresult = $this->object->getUser(1);
        $this->assertEquals($testUser, $actualresult);
    }

    /**
     * @covers dataSource::getCustomer
     * @todo   Implement testGetCustomer().
     */
    public function testGetCustomer() {
        // Remove the following lines when you implement this test.
        $testCustomer = new customer("Thomas Kragsberger", 1, "Bybækterrasserne 137 D", 3520, "Farum", 27708834);
        $actualresult = $this->object->getCustomer(1);

        $this->assertEquals($testCustomer, $actualresult);
        
    }

    /**
     * @covers dataSource::createAlarmReport
     * @todo   Implement testCreateAlarmReport().
     */
    public function testCreateAlarmReportFullAlarmRerport() {
        // Remove the following lines when you implement this test.
        $testAlarmReport = new alarmReport("test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test");
        $actualresult = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals($testAlarmReport, $actualresult);
        
        
    }
    public function testCreateAlarmReportMissingRows(){
        $testAlarmReport = new alarmReport(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualResult = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals($testAlarmReport, $actualResult);
                 
    }

    public function testCreateAlarmReportCustomerName(){
        $testAlarmReport = new alarmReport("Thomas", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualResult = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals("Thomas",$actualResult->getCustomerName());
        
        
    }
    public function testCreateAlarmReportCustomerNumber(){
        $testAlarmReport = new alarmReport(NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals(3, $actualReulst->getCustomerNumber());
        
        
    }
      public function testCreateAlarmReportStreetAndHouseNumber(){
        $testAlarmReport = new alarmReport(NULL, NULL, "Farum Stationsvej 2", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals("Farum Stationsvej 2", $actualReulst->getStreetAndHouseNumber());
        
        
    }
       public function testCreateAlarmReportZipCode(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , 2860, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals(2860, $actualReulst->getZipCode());
        
        
    }   public function testCreateAlarmReportCity(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, "Kgs. Lyngby", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals("Kgs. Lyngby", $actualReulst->getCity());
        
        
    }
       public function testCreateAlarmReportPhoneNumber(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, 22250898, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals(22250898, $actualReulst->getPhoneNumber());
        
        
    }   public function testCreateAlarmReportDate(){
        $testTime = new DateTime('18-04-2016');
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, $testTime, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals($testTime, $actualReulst->getDate());
        
        
    } public function testCreateAlarmReportTime(){
         $testTime = new DateTime('14:08:04');
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, $testTime, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals($testTime, $actualReulst->getTime());
        
        
    }public function testCreateAlarmReportZone(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, "Zone 4", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals("Zone 4", $actualReulst->getZone());
        
        
    }public function testCreateAlarmReportBurglaryVandalism(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, true, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals(true, $actualReulst->getBurglaryVandalism());
        
        
    }public function testCreateAlarmReportWindowDoorClosed(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, true, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals(true, $actualReulst->getWindowDoorClosed());
        
        
    }public function testCreateAlarmReportApprehendedPerson(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, true, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals(true, $actualReulst->getApprehendedPerson());
        
        
    }public function testCreateAlarmReportStaffError(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, true, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals(true, $actualReulst->getStaffError());
        
        
    }public function testCreateAlarmReportNothingToReport(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, true, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals(true, $actualReulst->getNothingToReport());
        
        
    }public function testCreateAlarmReportTechnicalError(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, true, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals(true, $actualReulst->getTechnicalError());
        
        
    }public function testCreateAlarmReportUnknownReason(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, true, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals(true, $actualReulst->getUnknownReason());
        
        
    }public function testCreateAlarmReportOther(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, true, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals(true, $actualReulst->getOther());
        
        
    }public function testCreateAlarmReportCancelDuringEmergency(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, true, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals(true, $actualReulst->getCancelDuringEmergency());
        
        
    }public function testCreateAlarmReportCoverMade(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, true, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals(true, $actualReulst->getCoverMade());
        
        
    }public function testCreateAlarmReportRemark(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, "Intet at bemærke", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals("Intet at bemærke", $actualReulst->getRemark());
        
        
    }public function testCreateAlarmReportName(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, "Mike", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals("Mike", $actualReulst->getName());
        
        
    }public function testCreateAlarmReportInstaller(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, "Per", NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals("Per", $actualReulst->getInstaller());
        
        
    }public function testCreateAlarmReportControlCenter(){
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, "Gryphon Security Aps", NULL, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals("Gryphon Security Aps", $actualReulst->getControlCenter());
        
        
    }public function testCreateAlarmReportGuardRadioedDate(){
        $testDate = new DateTime('16-03-2016');
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $testDate, NULL, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals($testDate, $actualReulst->getGuardRadioedDate());
        
        
    }public function testCreateAlarmReportGuardRadioedFrom(){
        $testTime = new DateTime('13:37:54');
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $testTime, NULL, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals($testTime, $actualReulst->getGuardRadioedFrom());
        
        
    }public function testCreateAlarmReportGuardRadioedTo(){
        $testTime = new DateTime('14:56:32');
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $testTime, NULL, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals($testTime, $actualReulst->getGuardRadioedTo());
        
        
    }public function testCreateAlarmReportArrivedAt(){
        $testTime = new DateTime('16:18:34');
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $testTime, NULL, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals($testTime, $actualReulst->getArrivedAt());
        
        
    }public function testCreateAlarmReportDone(){
        $testTime = new DateTime('22:30:34');
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $testTime, NULL);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals($testTime, $actualReulst->getDone());
        
        
    }public function testCreateAlarmReportUser(){
        $testUser = new User(1, "Thomas", "Kragsberger");
        $testAlarmReport = new alarmReport(NULL, NULL,NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL , NULL, $testUser);
        $actualReulst = $this->object->createAlarmReport($testAlarmReport);
        $this->assertEquals($testUser->getId(), $actualReulst->getUser()->getId());
        
        
    }
    
    
    
    
            
    /**
     * @covers dataSource::createAlarmReports
     * @todo   Implement testCreateAlarmReports().
     */
    public function testCreateAlarmReports() {
        // Remove the following lines when you implement this test.
       $testAlarmReport1 = new alarmReport("test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test");
       $testAlarmReport2 = new alarmReport("test1", "test1", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test", "test");
       $myArray = array($testAlarmReport1,$testAlarmReport2);
       $actualResult = $this->object->createAlarmReports($myArray);
       $this->assertEquals($myArray,$actualResult);
       
    }

    /**
     * @covers dataSource::getAddress
     * @todo   Implement testGetAddress().
     */
    public function testGetAddress() {
        // Remove the following lines when you implement this test.
        $testAddress = new address("Farum St.", 55.8117694, 12.373767000000043);
        $actualResult = $this->object->getAddress($testAddress->getAddressName());
        $this->assertEquals($testAddress->getAddressName(), $actualResult);
    }

}