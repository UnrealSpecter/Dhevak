<!-- projecten partial -->
<div id="content-wrapper" class="projecten hidden animated fadeIn">
    <!-- projecten menu -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 projecten-menu" onclick="openNav()"></div>

    <div class="project projecten-left"></div>
    <div class="project projecten-middle"></div>
    <div class="project projecten-right"></div>

    <div class="project-overlay invisible col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!-- Button to close the overlay navigation -->
        <a href="javascript:void(0)" class="closebtn" onclick="hideProjectDetails()">&times;</a>

        <div class="col-lg-12 project-bg-title center">PROJECT TITLE</div>

        <div class="flex col-lg-12" style="height: 100vh; width: 100vw; position: absolute; top: 0; left: 0; align-items: flex-end;">
            <img class="img-responsive" style="height: 20%; margin-bottom: 20px;" src="{{ URL::asset('/images/arrow-down.jpg') }}">
        </div>

        <div class="col-lg-12 project-title center">PROJECT TITLE</div>

        <div class="sub-title col-lg-12 center">onze rol</div>
        <div class="col-lg-12 project-roles-wrapper">
            <div class="col-lg-2 project-role flex">Website Design</div>
            <div class="col-lg-2 project-role flex">Social Media Marketing</div>
            <div class="col-lg-2 project-role flex">Grafisch Design</div>
        </div>

        <div class="sub-title col-lg-12 center">Het Project</div>
        <div class="col-lg-8 offset-lg-2 project-description flex animated slideInLeft">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mihi enim satis est, ipsis non satis. Diodorus, eius auditor, adiungit ad honestatem vacuitatem doloris.
        Non ego tecum iam ita iocabor, ut isdem his de rebus, cum L. Utilitatis causa amicitia est quaesita. Ergo, si semel tristior effectus est, hilara vita amissa est? Ac tamen hic mallet non dolere. Quod idem cum vestri faciant, non satis magnam tribuunt inventoribus gratiam. Quod quidem iam fit etiam in Academia.
        Expressa vero in iis aetatibus, quae iam confirmatae sunt. Cur iustitia laudatur? Verum tamen cum de rebus grandioribus dicas, ipsae res verba rapiunt; Uterque enim summo bono fruitur, id est voluptate. Etenim nec iustitia nec amicitia esse omnino poterunt, nisi ipsae per se expetuntur. Mihi enim erit isdem istis fortasse iam utendum. Quod ea non occurrentia fingunt, vincunt Aristonem;
        Scio enim esse quosdam, qui quavis lingua philosophari possint; Duo Reges: constructio interrete. Contemnit enim disserendi elegantiam, confuse loquitur. Etenim semper illud extra est, quod arte comprehenditur.
        Sunt autem, qui dicant foedus esse quoddam sapientium, ut ne minus amicos quam se ipsos diligant. Non est ista, inquam, Piso, magna dissensio. Possumusne ergo in vita summum bonum dicere, cum id ne in cena quidem posse videamur? Graece donan, Latine voluptatem vocant. Quid censes in Latino fore? Qui potest igitur habitare in beata vita summi mali metus?
        </div>

        <!-- bootstrap 4 carousel -->
        <div id="carouselExampleControls" class="carousel slide col-lg-8 offset-lg-2" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="d-block img-responsive" style="height: 100%; width: 100%;" src="{{ URL::asset('/images/projecten-test-image.jpg')}}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block img-responsive" style="height: 100%; width: 100%;" src="{{ URL::asset('/images/projecten-test-image.jpg')}}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block img-responsive" style="height: 100%; width: 100%;" src="{{ URL::asset('/images/projecten-test-image.jpg')}}" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="sub-title col-lg-12 center">het eindresultaat</div>
        <div class="col-lg-12 project-website center">
            <a href="" target="_blank"> WWW.PROJECT-WEBSITE.NL </a>
        </div>

        <div class="sub-title col-lg-12 center">Social Media</div>
        <div class="col-lg-12 project-social-media-wrapper">
            <div class="col-lg-2 project-social-media-link">
                <a class="flex" href="" target="_blank">FACEBOOK</a>
            </div>
            <div class="col-lg-2 project-social-media-link">
                <a class="flex" href="" target="_blank">TWITTER</a>
            </div>
            <div class="col-lg-2 project-social-media-link">
                <a class="flex" href="" target="_blank">INSTAGRAM</a>
            </div>
            <div class="col-lg-2 project-social-media-link">
                <a class="flex" href="" target="_blank">LINKEDIN</a>
            </div>
        </div>

    </div>
</div>
