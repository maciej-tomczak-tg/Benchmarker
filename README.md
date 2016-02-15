benchmarker
===========

A Symfony project to check how fast site is loading and compared it with competitors.

There are currently 2 reporters. When loading site in comparison exceeds specified ratio its being triggered.
Special configuration is for reporters in config.yml:

benchmarker:
    log_file_name: log.txt -- log file when all data about sites being tested will be written, this file resides in log file of the project (app/log)
    report:
        email_reporter:
            address: email@me.to -- email address to send email
            email_template: BenchmarkerBundle:emails:siteIsSlowerEmail.html.twig  -- template for email_reporter
            ratio: 1
        sms_reporter:
            phone: 1234567 - recipient sms number
            ratio: 2

to use email_reporter you have to configure you mailer
to use sms_reporter you have to implement working smsApi, Currently there is some dummy class which you can overwrite or plug yours

You can register your custom reporter, just create a service which implements BenchmarkerBundle\Report\ReporterInterface and tag it with name: benchmarker.report, you can look at service.yml

TODOS:
-Make more unit and functional tests
-Work on look & feel
-Log or do something with failed email and sms delivery