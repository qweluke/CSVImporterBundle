<?php
/**
 * Created by PhpStorm.
 * User: Łukasz Malicki
 * Date: 2017-05-02
 * Time: 10:31 AM
 */

namespace Qweluke\CSVImporterBundle\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * InvalidFileException.
 *
 * @author Łukasz Malicki
 */
class InvalidFileException extends HttpException
{
    /**
     * Constructor.
     *
     * @param string $message The internal exception message
     * @param \Exception $previous The previous exception
     * @param int $code The internal exception code
     */
    public function __construct($message = 'Given file is invalid.', \Exception $previous = null, $code = 0)
    {
        parent::__construct(Response::HTTP_BAD_REQUEST, $message, $previous, array(), $code);
    }
}
