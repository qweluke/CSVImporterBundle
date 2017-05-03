<?php

namespace Qweluke\CSVImporterBundle\Controller;

use Qweluke\CSVImporterBundle\Form\DataBindForm;
use Qweluke\CSVImporterBundle\Form\ImportForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;


class ImportController extends Controller
{

    /**
     * Step 1
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(ImportForm::class, []);
        $this->get('session')->set('qweluke_importer_data', null);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            /** @var UploadedFile $file */
            $file = $form->get('file')->getData();

            /** @var \Symfony\Component\Serializer\Serializer $serializer */
            $serializer = $this->get('serializer');

            $data = $serializer->decode(file_get_contents($file), 'csv');

            $this->get('qweluke_csv_importer.file_validator')->validate($data[1]);


            $this->get('session')->set('qweluke_importer_data', $data);

//            return $this->forward('QwelukeCSVImporterBundle:Import:bindColumns', [], $data);
            return $this->redirectToRoute('qweluke_csv_importer_bind');
        }

        return $this->render('QwelukeCSVImporterBundle:Default:importFile.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Step 2
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function bindColumnsAction(Request $request)
    {
        $sessionData = $this->get('session')->get('qweluke_importer_data');

        if(is_null($sessionData)) {
            $this->get('session')->getFlashBag()->add('info', 'Unable do bind types. Please import file first');
            return $this->redirectToRoute('qweluke_csv_importer_import');
        }

        $extendedClass = $this->getParameter('qweluke_csvimporter_import_class');

        $entityColumns = $this->getDoctrine()->getManager()->getClassMetadata($extendedClass)->getFieldNames();

        $form = $this->createForm(DataBindForm::class, null, [
            'csvColumns' => array_keys($sessionData[0]),
            'entityFields'=> $entityColumns,
            'requiredFields' => $this->getParameter('qweluke_csvimporter_requiredfields'),
            'attr' => [ 'id' => 'qweluke_databinding' ],
            'action' => $this->generateUrl('qweluke_csv_importer_bind')
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            /** @var array $binding */
            $binding = $form->get('columns')->getData();
            $importer = $this->get('qweluke_csv_importer.file_importer');

            /** prepare import data and save it! */
            $prepared = $importer->prepareData($sessionData, $binding);
            $importer->import($prepared);
        }

        return $this->render('QwelukeCSVImporterBundle:Default:bindColumns.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function confirmationAction(Request $request)
    {

    }
}
