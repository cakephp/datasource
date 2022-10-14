<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         5.0.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\Datasource\Paging;

use Cake\Datasource\ResultSetInterface;
use IteratorIterator;

/**
 * Paginated resultset.
 *
 * @method \Cake\Datasource\ResultSetInterface getInnerIterator()
 * @template-extends \IteratorIterator<mixed, mixed, \Traversable<mixed>>
 */
class PaginatedResultSet extends IteratorIterator implements PaginatedInterface
{
    /**
     * Paging params.
     *
     * @var array
     */
    protected array $params = [];

    /**
     * Constructor
     *
     * @param \Cake\Datasource\ResultSetInterface $results Resultset instance.
     * @param array $params Paging params.
     */
    public function __construct(ResultSetInterface $results, array $params)
    {
        parent::__construct($results);

        $this->params = $params;
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return $this->getInnerIterator()->count();
    }

    /**
     * @inheritDoc
     */
    public function items(): ResultSetInterface
    {
        return $this->getInnerIterator();
    }

    /**
     * @inheritDoc
     */
    public function totalCount(): ?int
    {
        return $this->params['totalCount'];
    }

    /**
     * @inheritDoc
     */
    public function perPage(): int
    {
        return $this->params['perPage'];
    }

    /**
     * @inheritDoc
     */
    public function pageCount(): ?int
    {
        return $this->params['pageCount'];
    }

    /**
     * @inheritDoc
     */
    public function currentPage(): int
    {
        return $this->params['currentPage'];
    }

    /**
     * @inheritDoc
     */
    public function hasPrevPage(): bool
    {
        return $this->params['hasPrevPage'];
    }

    /**
     * @inheritDoc
     */
    public function hasNextPage(): bool
    {
        return $this->params['hasNextPage'];
    }

    /**
     * @inheritDoc
     */
    public function pagingParam(string $name): mixed
    {
        return $this->params[$name] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function pagingParams(): array
    {
        return $this->params;
    }
}
